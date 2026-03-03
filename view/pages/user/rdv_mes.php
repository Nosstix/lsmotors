<?php
/**
 * VIEW - RDV en cours (employe/admin)
 * - Affiche uniquement les RDV pris par l'employé connecté
 * - Permet valider / annuler / remettre global
 */
if (!isset($_SESSION['utilisateur']) || !in_array($_SESSION['utilisateur']['Role'] ?? '', ['admin','employe'], true)) {
    echo '<div class="alert alert-danger">Accès refusé.</div>';
    return;
}

$idEmp = (int)$_SESSION['utilisateur']['ID'];
$model = new Rdv($bdd);
$rdvs = $model->getEnCoursByEmploye($idEmp);
?>
<h1 class="mb-4">Mes RDV en cours</h1>

<?php if (empty($rdvs)): ?>
    <div class="alert alert-info">Tu n'as aucun RDV en cours.</div>
<?php else: ?>
    <?php foreach ($rdvs as $r): ?>
        <div class="card bg-dark border mb-3">
            <div class="card-body">
                <h5 class="card-title">RDV #<?php echo (int)$r['ID']; ?> - Client: <?php echo htmlspecialchars($r['ClientDiscord'] ?? '—'); ?></h5>
                <p class="text-secondary mb-3">Dernière mise à jour: <?php echo htmlspecialchars($r['DateMaj']); ?></p>

                <!-- Bloc: items -->
                <?php $items = $model->getItems((int)$r['ID']); ?>
                <ul class="mb-3">
                    <?php foreach ($items as $it): ?>
                        <li>
                            <?php echo htmlspecialchars($it['MarqueNom'] . " " . $it['NomModele']); ?>
                            x<?php echo (int)$it['Quantite']; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <!-- Bloc: actions employé -->
                <div class="d-flex gap-2 flex-wrap">
                    <form method="post" action="index.php?page=rdv_validate" class="m-0">
                        <input type="hidden" name="rdv_id" value="<?php echo (int)$r['ID']; ?>">
                        <button class="btn btn-success btn-sm" type="submit">Valider</button>
                    </form>

                    <form method="post" action="index.php?page=rdv_cancel" class="m-0">
                        <input type="hidden" name="rdv_id" value="<?php echo (int)$r['ID']; ?>">
                        <button class="btn btn-danger btn-sm" type="submit">Annuler</button>
                    </form>

                    <form method="post" action="index.php?page=rdv_release" class="m-0">
                        <input type="hidden" name="rdv_id" value="<?php echo (int)$r['ID']; ?>">
                        <button class="btn btn-outline-light btn-sm" type="submit">Remettre global</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
