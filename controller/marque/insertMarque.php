<?php

function marqueInsert(PDO $bdd, array $data): int {
    $model = new Marque($bdd);
    return $model->create($data);
}