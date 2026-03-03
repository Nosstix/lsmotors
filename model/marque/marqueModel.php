<?php

class Marque {

    private $bdd;

    public function __construct($bdd){
        $this->bdd = $bdd;
    }

    // Récupérer toutes les marques
    public function getAll(){
        $req = $this->bdd->prepare("SELECT * FROM marque ORDER BY Nom ASC");
        $req->execute();
        return $req->fetchAll();
    }

    // Récupérer une marque par ID
    public function getById($id){
        $req = $this->bdd->prepare("SELECT * FROM marque WHERE ID = :id");
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch();
    }

    // Créer une marque
    public function create($data){
        $req = $this->bdd->prepare("
            INSERT INTO marque (Nom)
            VALUES (:Nom)
        ");

        $req->bindParam(':Nom', $data['Nom'], PDO::PARAM_STR);
        $req->execute();
        return $this->bdd->lastInsertId();
    }

    // Mettre à jour une marque
    public function update($id, $data){
        $req = $this->bdd->prepare("
            UPDATE marque 
            SET Nom = :Nom
            WHERE ID = :ID
        ");

        $req->bindParam(':Nom', $data['Nom'], PDO::PARAM_STR);
        $req->bindParam(':ID', $id, PDO::PARAM_INT);

        return $req->execute();
    }

    // Supprimer une marque
    public function delete($id){
        $req = $this->bdd->prepare("DELETE FROM marque WHERE ID = :id");
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        return $req->execute();
    }

}

?>