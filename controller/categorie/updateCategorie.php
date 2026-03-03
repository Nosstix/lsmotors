<?php

function categorieUpdate(PDO $bdd, int $id, array $data): bool {
    $model = new Categorie($bdd);
    return $model->update($id, $data);
}