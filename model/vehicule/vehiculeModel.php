<?php

class Vehicule {

    private $bdd;

    public function __construct($bdd){
        $this->bdd = $bdd;
    }

    // Récupérer tous les véhicules (avec marque + catégorie)
    public function getAll(){
        $req = $this->bdd->prepare("
            SELECT 
                v.*,
                m.Nom AS Marque,
                c.Libelle AS Categorie
            FROM vehicule v
            INNER JOIN marque m ON v.ID_Marque = m.ID
            INNER JOIN categorie c ON v.ID_Categorie = c.ID
            ORDER BY m.Nom ASC, v.NomModele ASC
        ");
        $req->execute();
        return $req->fetchAll();
    }

    // Récupérer un véhicule par ID
    public function getById($id){
        $req = $this->bdd->prepare("
            SELECT 
                v.*,
                m.Nom AS Marque,
                c.Libelle AS Categorie
            FROM vehicule v
            INNER JOIN marque m ON v.ID_Marque = m.ID
            INNER JOIN categorie c ON v.ID_Categorie = c.ID
            WHERE v.ID = :id
        ");
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch();
    }

    // Récupérer les véhicules par catégorie
    public function getByCategorie($idCategorie){
        $req = $this->bdd->prepare("
            SELECT 
                v.*,
                m.Nom AS Marque,
                c.Libelle AS Categorie
            FROM vehicule v
            INNER JOIN marque m ON v.ID_Marque = m.ID
            INNER JOIN categorie c ON v.ID_Categorie = c.ID
            WHERE v.ID_Categorie = :idCategorie
            ORDER BY m.Nom ASC, v.NomModele ASC
        ");
        $req->bindParam(':idCategorie', $idCategorie, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll();
    }

    // Rechercher des véhicules (par modèle ou marque), optionnellement filtré par catégorie
    public function search(string $q, int $idCategorie = 0): array
    {
        $q = trim($q);
        if ($q === '') return [];

        $like = '%' . $q . '%';

        if ($idCategorie > 0) {
            $req = $this->bdd->prepare("
                SELECT v.*, m.Nom AS Marque, c.Libelle AS Categorie
                FROM vehicule v
                INNER JOIN marque m ON v.ID_Marque = m.ID
                INNER JOIN categorie c ON v.ID_Categorie = c.ID
                WHERE v.ID_Categorie = :idCategorie
                AND (v.NomModele LIKE :q OR m.Nom LIKE :q)
                ORDER BY m.Nom ASC, v.NomModele ASC
            ");
            $req->bindValue(':idCategorie', $idCategorie, PDO::PARAM_INT);
            $req->bindValue(':q', $like, PDO::PARAM_STR);
            $req->execute();
            return $req->fetchAll();
        }

    $req = $this->bdd->prepare("
        SELECT v.*, m.Nom AS Marque, c.Libelle AS Categorie
        FROM vehicule v
        INNER JOIN marque m ON v.ID_Marque = m.ID
        INNER JOIN categorie c ON v.ID_Categorie = c.ID
        WHERE (v.NomModele LIKE :q OR m.Nom LIKE :q)
        ORDER BY m.Nom ASC, v.NomModele ASC
    ");
    $req->bindValue(':q', $like, PDO::PARAM_STR);
    $req->execute();
    return $req->fetchAll();
}


    // Créer un véhicule
    public function create($data){
        $req = $this->bdd->prepare("
            INSERT INTO vehicule 
                (NomModele, ID_Marque, ID_Categorie, PrixCatalogue, Description, Image, Actif)
            VALUES 
                (:NomModele, :ID_Marque, :ID_Categorie, :PrixCatalogue, :Description, :Image, :Actif)
        ");

        $req->bindParam(':NomModele', $data['NomModele'], PDO::PARAM_STR);
        $req->bindParam(':ID_Marque', $data['ID_Marque'], PDO::PARAM_INT);
        $req->bindParam(':ID_Categorie', $data['ID_Categorie'], PDO::PARAM_INT);
        $req->bindParam(':PrixCatalogue', $data['PrixCatalogue']);
        $req->bindParam(':Description', $data['Description'], PDO::PARAM_STR);
        $req->bindParam(':Image', $data['Image'], PDO::PARAM_STR);
        $req->bindParam(':Actif', $data['Actif'], PDO::PARAM_INT);

        $req->execute();
        return $this->bdd->lastInsertId();
    }

    // Mettre à jour un véhicule
    public function update($id, $data){
        $req = $this->bdd->prepare("
            UPDATE vehicule
            SET 
                NomModele    = :NomModele,
                ID_Marque    = :ID_Marque,
                ID_Categorie = :ID_Categorie,
                PrixCatalogue= :PrixCatalogue,
                Description  = :Description,
                Image        = :Image,
                Actif        = :Actif
            WHERE ID = :ID
        ");

        $req->bindParam(':NomModele', $data['NomModele'], PDO::PARAM_STR);
        $req->bindParam(':ID_Marque', $data['ID_Marque'], PDO::PARAM_INT);
        $req->bindParam(':ID_Categorie', $data['ID_Categorie'], PDO::PARAM_INT);
        $req->bindParam(':PrixCatalogue', $data['PrixCatalogue']);
        $req->bindParam(':Description', $data['Description'], PDO::PARAM_STR);
        $req->bindParam(':Image', $data['Image'], PDO::PARAM_STR);
        $req->bindParam(':Actif', $data['Actif'], PDO::PARAM_INT);
        $req->bindParam(':ID', $id, PDO::PARAM_INT);

        return $req->execute();

    
    }

    // Supprimer un véhicule
    public function delete($id){
        $req = $this->bdd->prepare("DELETE FROM vehicule WHERE ID = :id");
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        return $req->execute();
    }

}

?>