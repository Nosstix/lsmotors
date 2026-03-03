<?php

function venteUpdate(PDO $bdd, int $id, array $data): bool {
    $model = new Vente($bdd);
    return $model->update($id, $data);
}