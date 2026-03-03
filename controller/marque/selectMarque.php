<?php

function marqueSelectAll(PDO $bdd): array {
    $model = new Marque($bdd);
    return $model->getAll();
}

function marqueSelectById(PDO $bdd, int $id): ?array {
    $model = new Marque($bdd);
    return $model->getById($id);
}