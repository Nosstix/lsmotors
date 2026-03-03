<?php

class Config
{

    private $bdd;

    public function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    public function getMarge(): float
    {
        $req = $this->bdd->prepare("SELECT MargePourcent FROM config WHERE ID = 1");
        $req->execute();
        $row = $req->fetch();
        return $row ? (float) $row['MargePourcent'] : 40.0;
    }

    public function setMarge(float $marge): bool
    {
        $req = $this->bdd->prepare("UPDATE config SET MargePourcent = :m WHERE ID = 1");
        $req->bindParam(':m', $marge);
        return $req->execute();
    }
}

?>