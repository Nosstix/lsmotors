<?php

class Categorie {

    private $bdd;

    public function __construct($bdd){
        $this->bdd = $bdd;
    }

    // Récupérer toutes les catégories
    public function getAll(){
        $req = $this->bdd->prepare("SELECT * FROM categorie ORDER BY Libelle ASC");
        $req->execute();
        return $req->fetchAll();
    }

    // Récupérer une catégorie par ID
    public function getById($id){
        $req = $this->bdd->prepare("SELECT * FROM categorie WHERE ID = :id");
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch();
    }

    // Créer une catégorie
    public function create($data){
        $req = $this->bdd->prepare("
            INSERT INTO categorie (Libelle)
            VALUES (:Libelle)
        ");

        $req->bindParam(':Libelle', $data['Libelle'], PDO::PARAM_STR);
        $req->execute();
        return $this->bdd->lastInsertId();
    }

    // Mettre à jour une catégorie
    public function update($id, $data){
        $req = $this->bdd->prepare("
            UPDATE categorie 
            SET Libelle = :Libelle
            WHERE ID = :ID
        ");

        $req->bindParam(':Libelle', $data['Libelle'], PDO::PARAM_STR);
        $req->bindParam(':ID', $id, PDO::PARAM_INT);

        return $req->execute();
    }

    // Supprimer une catégorie
    public function delete($id){
        $req = $this->bdd->prepare("DELETE FROM categorie WHERE ID = :id");
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        return $req->execute();
    }

}

?>