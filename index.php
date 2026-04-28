<?php
// on recupère le chemin brut
$rawPath = dirname($_SERVER['SCRIPT_NAME']);

// on remplace les antslashes(windows) par des slashs normaux(Linux)
$cleanPath = str_replace('\\', '/', $rawPath);

// On enlève tout slash eventuel à la fin pour repartir d'une base propre
$cleanPath = rtrim($cleanPath, '/');

// on definit la constante
define('BASE_URL', $cleanPath . '/');
session_start();

/* ---------------------------------
   CONNEXION BDD
--------------------------------- */
require_once "bdd/bdd.php";

/* ---------------------------------
   AUTO-CHARGEMENT MODELS & CONTROLLERS
--------------------------------- */
function chargerDossier($dossier)
{
    foreach (glob($dossier . "/*.php") as $fichier) {
        require_once $fichier;
    }
}

/* ---------------------------------
   MODELS
--------------------------------- */
chargerDossier("model/utilisateur");
chargerDossier("model/categorie");
chargerDossier("model/marque");
chargerDossier("model/vehicule");
chargerDossier("model/vente");
chargerDossier("model/config");
chargerDossier("model/panier");
chargerDossier("model/rdv");

/* ---------------------------------
   CONTROLLERS
--------------------------------- */
chargerDossier("controller/utilisateur");
chargerDossier("controller/categorie");
chargerDossier("controller/marque");
chargerDossier("controller/vehicule");
chargerDossier("controller/vente");
chargerDossier("controller/config");
chargerDossier("controller/panier");
chargerDossier("controller/rdv");

/* ---------------------------------
   OUTILS (guards simples)
--------------------------------- */
function isLogged(): bool
{
    return isset($_SESSION['utilisateur']);
}

function role(): string
{
    return $_SESSION['utilisateur']['Role'] ?? 'joueur';
}

function requireRoles(array $roles): void
{
    if (!isLogged() || !in_array(role(), $roles, true)) {
        include "view/commun/header.php";
        echo '<div class="alert alert-danger">Accès refusé.</div>';
        include "view/commun/footer.php";
        exit;
    }
}

/* ---------------------------------
   PAGE PARAM
--------------------------------- */
$page = $_GET['page'] ?? 'accueil';

/* ---------------------------------
   ACTIONS (POST/GET techniques)
   (Important: on traite avant l’affichage)
--------------------------------- */

// ✅ Déconnexion (fix)
if ($page === 'deconnexion') {
    // bloc logout propre
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
    header("Location: index.php?page=connexion");
    exit;
}

// Add au panier (depuis liste véhicules)
if ($page === 'panier_add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    requireRoles(['joueur']);
    panierHandleAdd();
    header("Location: index.php?page=rdv");
    exit;
}

// Update panier
if ($page === 'panier_update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    requireRoles(['joueur']);
    panierHandleUpdate();
    header("Location: index.php?page=rdv");
    exit;
}

// ✅ Remove item (fix: on passe bien par POST vehicule_id)
if ($page === 'panier_remove' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    requireRoles(['joueur']);
    panierHandleRemove();
    header("Location: index.php?page=rdv");
    exit;
}

// Clear panier
if ($page === 'panier_clear' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    requireRoles(['joueur']);
    panierHandleClear();
    header("Location: index.php?page=rdv");
    exit;
}

// Soumettre demande RDV depuis panier
if ($page === 'rdv_submit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    requireRoles(['joueur']);
    $idClient = (int)($_SESSION['utilisateur']['ID'] ?? 0);
    rdvSubmitFromPanier($bdd, $idClient);
    header("Location: index.php?page=rdv_client");
    exit;
}

// Employé prend en charge un RDV
if ($page === 'rdv_take' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    requireRoles(['admin', 'employe']);
    $idEmploye = (int)($_SESSION['utilisateur']['ID'] ?? 0);
    rdvTake($bdd, $idEmploye, (int)($_POST['rdv_id'] ?? 0));
    header("Location: index.php?page=rdv_mes");
    exit;
}

// Employé remet un RDV dans les demandes
if ($page === 'rdv_release' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    requireRoles(['admin', 'employe']);
    $idEmploye = (int)($_SESSION['utilisateur']['ID'] ?? 0);
    rdvRelease($bdd, $idEmploye, (int)($_POST['rdv_id'] ?? 0));
    header("Location: index.php?page=rdv_demandes");
    exit;
}

// Employé valide un RDV
if ($page === 'rdv_validate' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    requireRoles(['admin', 'employe']);
    $idEmploye = (int)($_SESSION['utilisateur']['ID'] ?? 0);
    rdvValidate($bdd, $idEmploye, (int)($_POST['rdv_id'] ?? 0));
    header("Location: index.php?page=rdv_historique_employe");
    exit;
}

// Employé annule/supprime un RDV
if ($page === 'rdv_cancel' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    requireRoles(['admin', 'employe']);
    $idEmploye = (int)($_SESSION['utilisateur']['ID'] ?? 0);
    rdvCancel($bdd, $idEmploye, (int)($_POST['rdv_id'] ?? 0));
    header("Location: index.php?page=rdv_mes");
    exit;
}

/* Suggestions recherche (JSON) */
if ($page === 'search_suggest' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $q = trim($_GET['q'] ?? '');
    $idCategorie = (int)($_GET['id_categorie'] ?? 0);

    header('Content-Type: application/json; charset=utf-8');

    // petit garde-fou
    if ($q === '' || mb_strlen($q) < 2) {
        echo json_encode([]);
        exit;
    }

    // On réutilise la recherche existante (limité à 8 résultats côté model si tu peux)
    $results = vehiculeSearch($bdd, $q, $idCategorie);

    // On limite ici au cas où
    $results = array_slice($results, 0, 8);

    $payload = [];
    foreach ($results as $v) {
        $payload[] = [
            "id" => (int)$v["ID"],
            "label" => trim(($v["Marque"] ?? '') . " " . ($v["NomModele"] ?? '')),
            "marque" => $v["Marque"] ?? "",
            "modele" => $v["NomModele"] ?? "",
        ];
    }

    echo json_encode($payload);
    exit;
}


/* ---------------------------------
   HEADER GLOBAL
--------------------------------- */
include "view/commun/header.php";

/* ---------------------------------
   ROUTING VIEWS (pages)
--------------------------------- */
switch ($page) {

    // PAGES PUBLIQUES
    case 'accueil':
        include "view/pages/accueil.php";
        break;

    case 'categories':
        include "view/pages/categories.php";
        break;

    case 'listeVehicules':
        include "view/pages/listeVehicules.php";
        break;

    case 'contact':
        include "view/pages/contact.php";
        break;

    // LOGIN / SIGNUP
    case 'connexion':
        include "view/pages/login/connexion.php";
        break;

    case 'inscription':
        include "view/pages/login/inscription.php";
        break;

    // PANIER / RDV (JOUEUR)
    case 'rdv':
        requireRoles(['joueur']);
        include "view/pages/user/rdv.php";
        break;

    case 'rdv_client':
        requireRoles(['joueur']);
        include "view/pages/user/rdv_client.php";
        break;

    case 'profil':
        requireRoles(['joueur']);
        include "view/pages/user/profil.php";
        break;

    case 'achats':
        requireRoles(['joueur']);
        include "view/pages/user/achats.php";
        break;

    // RDV (EMPLOYÉ / ADMIN)
    case 'rdv_demandes':
        requireRoles(['admin', 'employe']);
        include "view/pages/user/rdv_demandes.php";
        break;

    case 'rdv_mes':
        requireRoles(['admin', 'employe']);
        include "view/pages/user/rdv_mes.php";
        break;

    case 'rdv_historique_employe':
        requireRoles(['admin', 'employe']);
        include "view/pages/user/rdv_historique_employe.php";
        break;

    // VENTES (EMPLOYÉ / ADMIN)
    case 'ventes_ajouter':
        requireRoles(['admin', 'employe']);
        include "view/pages/user/ventes_ajouter.php";
        break;

    case 'ventes_historique':
        requireRoles(['admin', 'employe']);
        include "view/pages/user/ventes_historique.php";
        break;

    // ADMIN (page unique)
    case 'admin':
        requireRoles(['admin']);
        include "view/pages/user/admin/admin_page.php";
        break;

    default:
        include "view/pages/accueil.php";
        break;
}

include "view/commun/footer.php";
