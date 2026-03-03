<?php

function marqueUpdate(PDO $bdd, int $id, array $data): bool {
    $model = new Marque($bdd);
    return $model->update($id, $data);
}