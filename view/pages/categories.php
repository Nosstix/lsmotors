<?php
// On récupère les catégories avec le comptage des véhicules actifs
// Si vous préférez garder votre fonction, vous devrez modifier le SQL à l'intérieur de celle-ci.
$sql = "SELECT c.ID, c.Libelle, COUNT(v.ID) AS nb_vehicules
        FROM categorie c
        LEFT JOIN vehicule v ON c.ID = v.ID_Categorie AND v.Actif = 1
        GROUP BY c.ID
        ORDER BY c.Libelle ASC";

$stmt = $bdd->query($sql);
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1 class="mb-4">Catégories de véhicules</h1>

<?php if (empty($categories)): ?>
    <div class="alert alert-warning">
        Aucune catégorie trouvée.
    </div>
<?php else: ?>
    <div class="row row-cols-1 row-cols-md-3 g-3">
        <?php foreach ($categories as $cat): ?>
            <div class="col">
                <div class="card h-100 bg-secondary text-light">
                    <div class="card-body d-flex flex-column justify-content-between">

                        <h5 class="card-title">
                            <?php echo htmlspecialchars($cat['Libelle']); ?>
                            <small class="text-light text-opacity-75" style="font-size: 0.8em;">
                                (<?php echo $cat['nb_vehicules']; ?>)
                            </small>
                        </h5>

                        <a href="index.php?page=listeVehicules&id_categorie=<?php echo $cat['ID']; ?>"
                            class="btn btn-outline-light mt-3">
                            Voir les véhicules
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>