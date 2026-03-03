<?php

function configSetMarge(PDO $bdd, float $marge): bool
{
    $model = new Config($bdd);
    return $model->setMarge($marge);
}