<?php
// controller delete pour les cataegories

function categorieDelete(PDO $bdd, int $id): bool {
    $model = new Categorie($bdd);
    return $model->delete($id);
}
