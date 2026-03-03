<?php
//  controller config qui donne la marge

function configGetMarge(PDO $bdd): float
{
    $model = new Config($bdd);
    return $model->getMarge();
}
