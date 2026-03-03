<?php
/**
 * rdvController.php
 *
 * Gère les demandes de RDV:
 * - Un client transforme son panier en demande de RDV (rdv + rdv_item)
 * - Un employé/admin peut prendre en charge / remettre / valider / annuler un RDV
 */

function rdvSubmitFromPanier(PDO $bdd, int $idClient): ?int
{
    $panier = panierGet();
    if (empty($panier)) {
        return null;
    }

    $vehicules = vehiculeSelectAll($bdd);
    $vehById = [];
    foreach ($vehicules as $v) {
        $vehById[(int)$v['ID']] = $v;
    }

    $rdv = new Rdv($bdd);
    $idRdv = $rdv->createRdv($idClient);

    foreach ($panier as $vehId => $qty) {
        $vehId = (int)$vehId;
        $qty = (int)$qty;
        if ($qty <= 0 || !isset($vehById[$vehId])) continue;

        $prixU = (float)$vehById[$vehId]['PrixCatalogue'];
        $rdv->addItem($idRdv, $vehId, $qty, $prixU);
    }

    panierClear();
    return $idRdv;
}

function rdvTake(PDO $bdd, int $idEmploye, int $idRdv): void
{
    if ($idRdv <= 0) return;
    (new Rdv($bdd))->prendre($idRdv, $idEmploye);
}

function rdvRelease(PDO $bdd, int $idEmploye, int $idRdv): void
{
    if ($idRdv <= 0) return;
    (new Rdv($bdd))->remettreGlobal($idRdv, $idEmploye);
}

function rdvValidate(PDO $bdd, int $idEmploye, int $idRdv): void
{
    if ($idRdv <= 0) return;
    (new Rdv($bdd))->valider($idRdv, $idEmploye);
}

function rdvCancel(PDO $bdd, int $idEmploye, int $idRdv): void
{
    if ($idRdv <= 0) return;
    (new Rdv($bdd))->annuler($idRdv, $idEmploye);
}


function rdvGetClientStats(PDO $bdd, int $idClient): array
{
    $rdv = new Rdv($bdd);

    // RDV validés (historique)
    $hist = $rdv->getHistoriqueByClient($idClient);
    $nb = count($hist);

    // Total dépensé (somme des items des RDV validés)
    $req = $bdd->prepare("
        SELECT COALESCE(SUM(i.Quantite * i.PrixUnitaire), 0) AS total
        FROM rdv r
        JOIN rdv_item i ON i.ID_RDV = r.ID
        WHERE r.ID_Client = :idClient AND r.Statut = 'valide'
    ");
    $req->execute([':idClient' => $idClient]);
    $total = (float)($req->fetch()['total'] ?? 0);

    return ['nb_rdv' => $nb, 'total_depense' => $total];
}
