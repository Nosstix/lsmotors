<?php

function vehiculeSelectAll(PDO $bdd): array {
    $model = new Vehicule($bdd);
    return $model->getAll();
}

function vehiculeSelectById(PDO $bdd, int $id): ?array {
    $model = new Vehicule($bdd);
    return $model->getById($id);
}

function vehiculeSelectByCategorie(PDO $bdd, int $idCategorie): array {
    $model = new Vehicule($bdd);
    return $model->getByCategorie($idCategorie);
}

function vehiculeSearch(PDO $bdd, string $q, int $idCategorie = 0): array {
    $model = new Vehicule($bdd);
    return $model->search($q, $idCategorie);
}