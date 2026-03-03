<?php
//  controller config qui donne la marge et selectionne une config

function configGetMarge(PDO $bdd): float
{
    $model = new Config($bdd);
    return $model->getMarge();
}
