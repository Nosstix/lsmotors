<?php

function venteDelete(PDO $bdd, int $id): bool {
    $model = new Vente($bdd);
    return $model->delete($id);
}