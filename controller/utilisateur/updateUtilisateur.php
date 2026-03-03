<?php

function utilisateurUpdate(PDO $bdd, int $id, array $data): bool {
    $model = new Utilisateur($bdd);
    return $model->update($id, $data);
}