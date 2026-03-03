<?php
/**
 * VIEW - Demandes de RDV (employe/admin)
 * - Liste globale des RDV en attente
 * - Permet de "prendre" un RDV (devient privé)
 */

if (!isset($_SESSION['utilisateur']) || !in_array($_SESSION['utilisateur']['Role'] ?? '', ['admin','employe'], true)) {
    echo '<div class="alert alert-danger">Accès refusé.</div>';
    return;
}

$model = new Rdv($bdd);
$demandes = $model->getDemandes();
?>
<h1 class="mb-4">Demandes de RDV</h1>

<?php if (empty($demandes)): ?>
    <div class="alert alert-info">Aucune demande en attente.</div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-dark table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($demandes as $d): ?>
                <tr>
                    <td>#<?php echo (int)$d['ID']; ?></td>
                    <td><?php echo htmlspecialchars($d['ClientDiscord'] ?? '—'); ?></td>
                    <td><?php echo htmlspecialchars($d['DateCreation']); ?></td>
                    <td>
                        <form method="post" action="index.php?page=rdv_take" class="m-0">
                            <input type="hidden" name="rdv_id" value="<?php echo (int)$d['ID']; ?>">
                            <button class="btn btn-success btn-sm" type="submit">Prendre</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
