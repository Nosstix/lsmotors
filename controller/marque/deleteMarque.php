<?php

function marqueDelete(PDO $bdd, int $id): bool {
    $model = new Marque($bdd);
    return $model->delete($id);
}