<?php
/**
 * VIEW - Historique achats client (joueur)
 * - Montre les RDV validés
 */
if (!isset($_SESSION['utilisateur'])) {
    echo '<div class="alert alert-danger">Accès refusé.</div>';
    return;
}
$idClient = (int)$_SESSION['utilisateur']['ID'];

$model = new Rdv($bdd);
$achats = $model->getHistoriqueByClient($idClient);
?>
<h1 class="mb-4">Mes anciens achats</h1>

<?php if (empty($achats)): ?>
    <div class="alert alert-info">Aucun achat validé pour l'instant.</div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-dark table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employé</th>
                    <th>Date</th>
                    <th>Détails</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($achats as $a): ?>
                <tr>
                    <td>#<?php echo (int)$a['ID']; ?></td>
                    <td><?php echo htmlspecialchars($a['EmployeDiscord'] ?? '—'); ?></td>
                    <td><?php echo htmlspecialchars($a['DateMaj']); ?></td>
                    <td>
                        <a class="btn btn-outline-light btn-sm" href="index.php?page=rdv_client">Voir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
