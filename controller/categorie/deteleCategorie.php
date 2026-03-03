<?php

function categorieDelete(PDO $bdd, int $id): bool {
    $model = new Categorie($bdd);
    return $model->delete($id);
}