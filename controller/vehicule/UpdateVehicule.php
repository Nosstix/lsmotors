<?php

function vehiculeUpdate(PDO $bdd, int $id, array $data): bool {
    $model = new Vehicule($bdd);
    return $model->update($id, $data);
}