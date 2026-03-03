<?php
/**
 * VIEW - Liste des véhicules
 * - Affiche toutes les cards véhicules
 * - Bouton "Photo" (ouvre l'image)
 * - Bouton "Prendre RDV" :
 *      - si joueur connecté => ajoute au panier (POST panier_add)
 *      - si non connecté => redirige vers connexion
 *      - si employé/admin => bouton désactivé (pas concerné)
 * - Recherche (q) :
 *      - si q est rempli => affiche les véhicules correspondant (NomModele ou Marque)
 *      - si id_categorie est présent => recherche limitée à cette catégorie
 */

$idCategorie = isset($_GET['id_categorie']) ? (int)$_GET['id_categorie'] : 0;
$q = trim($_GET['q'] ?? '');

/* Label catégorie */
$categorieLabel = null;
if ($idCategorie > 0) {
    $cat = categorieSelectById($bdd, $idCategorie);
    $categorieLabel = $cat['Libelle'] ?? null;
}

/* Liste véhicules (catégorie OU recherche) */
if ($q !== '') {
    // Nécessite vehiculeSearch($bdd, $q, $idCategorie)
    $vehicules = vehiculeSearch($bdd, $q, $idCategorie);
} else {
    $vehicules = ($idCategorie > 0) ? vehiculeSelectByCategorie($bdd, $idCategorie) : vehiculeSelectAll($bdd);
}

$imgBase = "/lsMotors/view/public/img/image_voiture/";
$imgDefault = $imgBase . "default.png";

$role = $_SESSION['utilisateur']['Role'] ?? null;
$isJoueur = ($role === 'joueur');
$isLogged = isset($_SESSION['utilisateur']);
?>

<h1 class="mb-4">
    <?php
    if ($q !== '') {
        echo "Résultats pour : " . htmlspecialchars($q);
        if ($categorieLabel) echo " - " . htmlspecialchars($categorieLabel);
    } else {
        echo "Liste des véhicules" . ($categorieLabel ? ' - ' . htmlspecialchars($categorieLabel) : '');
    }
    ?>
</h1>

<?php if (empty($vehicules)): ?>
<div class="alert alert-warning">Aucun véhicule trouvé.</div>
<?php else: ?>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php foreach ($vehicules as $v): ?>

    <?php
            $imgUrl = $imgDefault;

            if (!empty($v['Image'])) {
                $imgDb = trim($v['Image']);
                if (preg_match('~^https?://~i', $imgDb) || str_starts_with($imgDb, '/')) {
                    $imgUrl = $imgDb;
                } else {
                    $imgUrl = $imgBase . rawurlencode($imgDb);
                }
            } else {
                $nomImage = strtolower($v['NomModele']);
                $nomImage = str_replace([' ', '-', '_'], '', $nomImage);
                $imgUrl = $imgBase . $nomImage . ".png";
            }
            ?>

    <div class="col">
        <div class="card h-100 bg-secondary text-light">
            <img src="<?php echo htmlspecialchars($imgUrl); ?>" class="card-img-top vehicule-card-img"
                alt="<?php echo htmlspecialchars(($v['Marque'] ?? '') . ' ' . $v['NomModele']); ?>"
                onerror="this.onerror=null;this.src='<?php echo $imgDefault; ?>';">

            <div class="card-body d-flex flex-column">
                <h5 class="card-title mb-1">
                    <?php echo htmlspecialchars(($v['Marque'] ?? '') . ' ' . $v['NomModele']); ?>
                </h5>

                <p class="card-text mb-2">
                    Prix catalogue : <?php echo number_format((float)$v['PrixCatalogue'], 0, ',', ' '); ?> $
                </p>

                <div class="d-flex gap-2 mt-auto">
                    <a class="btn btn-outline-light flex-fill" href="<?php echo htmlspecialchars($imgUrl); ?>"
                        target="_blank" rel="noopener">
                        Photo
                    </a>

                    <?php if ($isJoueur): ?>
                    <form class="flex-fill" method="post" action="index.php?page=panier_add">
                        <input type="hidden" name="vehicule_id" value="<?php echo (int)$v['ID']; ?>">
                        <input type="hidden" name="quantite" value="1">
                        <button class="btn btn-success w-100" type="submit">Prendre RDV</button>
                    </form>

                    <?php elseif (!$isLogged): ?>
                    <a class="btn btn-success flex-fill" href="index.php?page=connexion">
                        Prendre RDV
                    </a>

                    <?php else: ?>
                    <button class="btn btn-success flex-fill" type="button" disabled>
                        Prendre RDV
                    </button>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>

    <?php endforeach; ?>
</div>

<?php endif; ?>