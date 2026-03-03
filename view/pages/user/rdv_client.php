<?php
/**
 * VIEW - RDV client (joueur)
 * - Affiche les RDV du client (dernier ou en cours)
 * - Indique le statut et l'employé (si pris)
 */

if (!isset($_SESSION['utilisateur'])) {
    echo '<div class="alert alert-danger">Accès refusé.</div>';
    return;
}

$idClient = (int)$_SESSION['utilisateur']['ID'];

$model = new Rdv($bdd);

// Bloc: récupérer le dernier RDV du client (demande/en_cours/valide/annule)
$req = $bdd->prepare("
    SELECT r.*, e.DiscordPseudo AS EmployeDiscord
    FROM rdv r
    LEFT JOIN utilisateur e ON e.ID = r.ID_Employe
    WHERE r.ID_Client = :idClient
    ORDER BY r.DateMaj DESC
    LIMIT 1
");
$req->execute([':idClient' => $idClient]);
$rdv = $req->fetch();

?>
<h1 class="mb-4">Mon RDV</h1>

<?php if (!$rdv): ?>
    <div class="alert alert-info">
        Tu n'as encore aucune demande. Ajoute des véhicules au panier puis envoie la demande.
    </div>
<?php else: ?>
    <?php
        $statut = $rdv['Statut'];
        $label = $statut;
        if ($statut === 'demande') $label = "En attente (pas encore pris en charge)";
        if ($statut === 'en_cours') $label = "Pris en charge";
        if ($statut === 'valide') $label = "Validé (achat terminé)";
        if ($statut === 'annule') $label = "Annulé";
    ?>

    <!-- Bloc: infos RDV -->
    <div class="card bg-dark border mb-3">
        <div class="card-body">
            <p><b>Statut :</b> <?php echo htmlspecialchars($label); ?></p>
            <p><b>Employé :</b> <?php echo htmlspecialchars($rdv['EmployeDiscord'] ?? '—'); ?></p>
            <p class="text-secondary mb-0"><b>Dernière mise à jour :</b> <?php echo htmlspecialchars($rdv['DateMaj']); ?></p>
        </div>
    </div>

    <!-- Bloc: lignes du RDV -->
    <?php
        $items = $model->getItems((int)$rdv['ID']);
        $total = 0;
    ?>
    <div class="table-responsive">
        <table class="table table-dark table-striped align-middle">
            <thead>
                <tr>
                    <th>Véhicule</th>
                    <th>Prix unité</th>
                    <th>Qté</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $it):
                $lt = (float)$it['PrixUnitaire'] * (int)$it['Quantite'];
                $total += $lt;
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($it['MarqueNom'] . " " . $it['NomModele']); ?></td>
                    <td><?php echo number_format((float)$it['PrixUnitaire'], 0, ',', ' '); ?> $</td>
                    <td><?php echo (int)$it['Quantite']; ?></td>
                    <td><?php echo number_format($lt, 0, ',', ' '); ?> $</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-end">Total</th>
                    <th><?php echo number_format($total, 0, ',', ' '); ?> $</th>
                </tr>
            </tfoot>
        </table>
    </div>
<?php endif; ?>
