<?php

function vehiculeDelete(PDO $bdd, int $id): bool {
    $model = new Vehicule($bdd);
    return $model->delete($id);
}