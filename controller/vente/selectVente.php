<?php

function venteSelectAll(PDO $bdd): array
{
    $model = new Vente($bdd);
    return $model->getAll();
}

function venteSelectById(PDO $bdd, int $id): ?array
{
    $model = new Vente($bdd);
    return $model->getById($id);
}

function venteSelectByEmploye(PDO $bdd, int $idEmploye): array
{
    $model = new Vente($bdd);
    return $model->getByEmploye($idEmploye);
}

function venteResumeParSemaineEmploye(PDO $bdd, int $idEmploye): array
{
    $model = new Vente($bdd);
    return $model->getResumeParSemaineEmploye($idEmploye);
}

function venteGetWeeks(PDO $bdd): array
{
    $model = new Vente($bdd);
    return $model->getWeeks();
}

function venteStatsEmployesByWeek(PDO $bdd, int $semaine): array
{
    $model = new Vente($bdd);
    return $model->getStatsEmployesByWeek($semaine);
}