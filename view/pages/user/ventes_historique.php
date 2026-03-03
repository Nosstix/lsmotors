<?php
// Sécurité
if (!isset($_SESSION['utilisateur'])) {
    echo '<div class="alert alert-danger">Accès refusé.</div>';
    return;
}

$idEmploye = (int) $_SESSION['utilisateur']['ID'];

// Messages
$success = "";
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $success = "La vente a bien été enregistrée.";
}

// Récupérer les données
$ventes = venteSelectByEmploye($bdd, $idEmploye);
$resume = venteResumeParSemaineEmploye($bdd, $idEmploye);
?>

<h1 class="mb-4">Mes ventes</h1>

<?php if (!empty($success)): ?>
    <div class="alert alert-success">
        <?php echo htmlspecialchars($success); ?>
    </div>
<?php endif; ?>

<?php if (empty($ventes)): ?>
    <div class="alert alert-info">
        Vous n'avez enregistré aucune vente pour le moment.
    </div>

    <a href="index.php?page=ventes_ajouter" class="btn btn-light mt-2">
        Enregistrer ma première vente
    </a>
<?php else: ?>

    <h2 class="h5 mt-3">Résumé par semaine</h2>

    <?php if (empty($resume)): ?>
        <div class="alert alert-info">
            Aucun résumé disponible.
        </div>
    <?php else: ?>
        <div class="table-responsive mb-4">
            <table class="table table-dark table-striped align-middle">
                <thead>
                    <tr>
                        <th>Semaine (année-semaine)</th>
                        <th>Nombre de ventes</th>
                        <th>Total vendu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resume as $r): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($r['Semaine']); ?></td>
                            <td><?php echo (int) $r['NbVentes']; ?></td>
                            <td><?php echo number_format($r['TotalVentes'], 0, ',', ' '); ?> $</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <h2 class="h5 mt-4">Détail de mes ventes</h2>

    <div class="table-responsive">
        <table class="table table-dark table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date de vente</th>
                    <th>Véhicule</th>
                    <th>Client</th>
                    <th>Prix de vente</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ventes as $v): ?>
                    <tr>
                        <td><?php echo (int) $v['ID']; ?></td>
                        <td><?php echo htmlspecialchars($v['DateVente']); ?></td>
                        <td><?php echo htmlspecialchars($v['Marque'] . ' ' . $v['NomModele']); ?></td>
                        <td><?php echo htmlspecialchars($v['NomClient']); ?></td>

                        <td class="<?php echo $classeCouleur; ?> fw-bold">
                            <?php echo number_format($v['PrixVente'], 0, ',', ' '); ?> $
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php endif; ?>