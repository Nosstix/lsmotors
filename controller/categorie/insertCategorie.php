<?php

function categorieInsert(PDO $bdd, array $data): int {
    $model = new Categorie($bdd);
    return $model->create($data);
}