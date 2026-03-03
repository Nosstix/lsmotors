<?php

function vehiculeInsert(PDO $bdd, array $data): int {
    $model = new Vehicule($bdd);
    return $model->create($data);
}