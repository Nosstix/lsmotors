<?php

function utilisateurDelete(PDO $bdd, int $id): bool {
    $model = new Utilisateur($bdd);
    return $model->delete($id);
}