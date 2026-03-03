<?php
/**
 * VIEW - Historique RDV employé (employe/admin)
 * - Montre tous les RDV validés par l'employé
 */
if (!isset($_SESSION['utilisateur']) || !in_array($_SESSION['utilisateur']['Role'] ?? '', ['admin','employe'], true)) {
    echo '<div class="alert alert-danger">Accès refusé.</div>';
    return;
}
$idEmp = (int)$_SESSION['utilisateur']['ID'];
$model = new Rdv($bdd);
$hist = $model->getHistoriqueByEmploye($idEmp);
?>
<h1 class="mb-4">Mes RDV validés</h1>

<?php if (empty($hist)): ?>
    <div class="alert alert-info">Aucun RDV validé.</div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-dark table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($hist as $h): ?>
                <tr>
                    <td>#<?php echo (int)$h['ID']; ?></td>
                    <td><?php echo htmlspecialchars($h['ClientDiscord'] ?? '—'); ?></td>
                    <td><?php echo htmlspecialchars($h['DateMaj']); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
