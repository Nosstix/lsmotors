<?php

function utilisateurSelectAll(PDO $bdd): array {
    $model = new Utilisateur($bdd);
    return $model->getAll();
}

function utilisateurSelectById(PDO $bdd, int $id): ?array {
    $model = new Utilisateur($bdd);
    return $model->getById($id);
}

function utilisateurSelectByEmail(PDO $bdd, string $email): ?array {
    $model = new Utilisateur($bdd);
    return $model->getByEmail($email);
}