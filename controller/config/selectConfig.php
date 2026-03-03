<?php

function configGetMarge(PDO $bdd): float
{
    $model = new Config($bdd);
    return $model->getMarge();
}