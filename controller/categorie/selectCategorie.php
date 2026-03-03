<?php

function categorieSelectAll(PDO $bdd): array {
    $model = new Categorie($bdd);
    return $model->getAll();
}

function categorieSelectById(PDO $bdd, int $id): ?array {
    $model = new Categorie($bdd);
    return $model->getById($id);
}