<?php
/**
 * VIEW - Panier / prise de RDV (joueur)
 *
 * BLOC 1: Récupère le panier (session)
 * BLOC 2: Récupère les véhicules pour afficher nom + prix
 * BLOC 3: Affiche tableau + formulaires (update/remove/clear/submit)
 */

$panier = panierGet(); // [vehiculeId => qty]

$vehicules = vehiculeSelectAll($bdd);
$vehById = [];
foreach ($vehicules as $v) {
    $vehById[(int)$v['ID']] = $v;
}

// Calcul totaux
$total = 0;
foreach ($panier as $vehId => $qty) {
    $vehId = (int)$vehId;
    $qty = (int)$qty;
    if ($qty <= 0 || !isset($vehById[$vehId])) continue;
    $prixU = (float)$vehById[$vehId]['PrixCatalogue'];
    $total += $prixU * $qty;
}
?>

<h1 class="mb-4">Mon panier RDV</h1>

<?php if (empty($panier)): ?>
<div class="alert alert-info">
    Ton panier est vide. Tu peux ajouter un véhicule depuis la liste.
</div>
<a class="btn btn-outline-light" href="index.php?page=categories">Voir les catégories</a>
<?php else: ?>

<!-- =========================
         BLOC UPDATE QUANTITÉS
         - Envoie items[vehiculeId] = qty
    ========================== -->
<form method="post" action="index.php?page=panier_update">
    <div class="table-responsive">
        <table class="table table-dark table-striped align-middle">
            <thead>
                <tr>
                    <th>Véhicule</th>
                    <th class="text-end">Prix unité</th>
                    <th style="width:140px;">Quantité</th>
                    <th class="text-end">Total ligne</th>
                    <th style="width:140px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($panier as $vehId => $qty): ?>
                <?php
                        $vehId = (int)$vehId;
                        $qty = (int)$qty;

                        if (!isset($vehById[$vehId])) continue;

                        $v = $vehById[$vehId];
                        $prixU = (float)$v['PrixCatalogue'];
                        $ligne = $prixU * max($qty, 0);
                        ?>
                <tr>
                    <td>
                        <?php echo htmlspecialchars(($v['Marque'] ?? '') . ' ' . $v['NomModele']); ?>
                    </td>
                    <td class="text-end">
                        <?php echo number_format($prixU, 0, ',', ' '); ?> $
                    </td>
                    <td>
                        <input type="number" class="form-control form-control-sm" name="items[<?php echo $vehId; ?>]"
                            value="<?php echo $qty; ?>" min="0">
                        <div class="form-text text-secondary">
                            0 = supprime
                        </div>
                    </td>
                    <td class="text-end">
                        <?php echo number_format($ligne, 0, ',', ' '); ?> $
                    </td>
                    <td>
                        <!-- =========================
                                     BLOC SUPPRIMER ITEM (fix)
                                     - Envoie vehicule_id en POST
                                ========================== -->
                        <button class="btn btn-danger btn-sm w-100" type="submit" formaction="index.php?page=panier_remove" name="vehicule_id" value="<?php echo $vehId; ?>">Supprimer</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-end">Total</th>
                    <th class="text-end"><?php echo number_format($total, 0, ',', ' '); ?> $</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="d-flex flex-wrap gap-2">
        <button class="btn btn-light" type="submit">Mettre à jour</button>
        <a class="btn btn-outline-light" href="index.php?page=categories">Ajouter d'autres véhicules</a>
    </div>
</form>

<hr class="my-4">

<div class="d-flex flex-wrap gap-2">
    <!-- =========================
             BLOC VIDER PANIER
        ========================== -->
    <form method="post" action="index.php?page=panier_clear">
        <button class="btn btn-outline-danger" type="submit">Vider le panier</button>
    </form>

    <!-- =========================
             BLOC ENVOYER DEMANDE RDV
        ========================== -->
    <form method="post" action="index.php?page=rdv_submit">
        <button class="btn btn-success" type="submit">Envoyer la demande de RDV</button>
    </form>
</div>

<?php endif; ?>