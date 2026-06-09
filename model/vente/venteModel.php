<?php

class Vente
{

    private $bdd;

    public function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    public function getAll()
    {
        $req = $this->bdd->prepare("
            SELECT 
                ve.*,
                u.Nom AS NomEmploye,
                u.Prenom AS PrenomEmploye,
                v.NomModele,
                v.PrixCatalogue,
                m.Nom AS Marque
            FROM vente ve
            INNER JOIN utilisateur u ON ve.ID_Employe = u.ID
            INNER JOIN vehicule v ON ve.ID_Vehicule = v.ID
            INNER JOIN marque m ON v.ID_Marque = m.ID
            ORDER BY ve.DateVente DESC
        ");
        $req->execute();
        return $req->fetchAll();
    }

    public function getById($id)
    {
        $req = $this->bdd->prepare("
            SELECT 
                ve.*,
                u.Nom AS NomEmploye,
                u.Prenom AS PrenomEmploye,
                v.NomModele,
                v.PrixCatalogue,
                m.Nom AS Marque
            FROM vente ve
            INNER JOIN utilisateur u ON ve.ID_Employe = u.ID
            INNER JOIN vehicule v ON ve.ID_Vehicule = v.ID
            INNER JOIN marque m ON v.ID_Marque = m.ID
            WHERE ve.ID = :id
        ");
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch();
    }

    public function getByEmploye($idEmploye)
    {
        $req = $this->bdd->prepare("
            SELECT 
                ve.*,
                v.NomModele,
                v.PrixCatalogue,
                m.Nom AS Marque
            FROM vente ve
            INNER JOIN vehicule v ON ve.ID_Vehicule = v.ID
            INNER JOIN marque m ON v.ID_Marque = m.ID
            WHERE ve.ID_Employe = :idEmploye
            ORDER BY ve.DateVente DESC
        ");
        $req->bindParam(':idEmploye', $idEmploye, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll();
    }

    public function getResumeParSemaineEmploye($idEmploye)
    {
        $req = $this->bdd->prepare("
            SELECT 
                YEARWEEK(DateVente, 1) AS Semaine,
                COUNT(*) AS NbVentes,
                SUM(PrixVente) AS TotalVentes
            FROM vente
            WHERE ID_Employe = :idEmploye
            GROUP BY YEARWEEK(DateVente, 1)
            ORDER BY Semaine DESC
        ");
        $req->bindParam(':idEmploye', $idEmploye, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll();
    }

    // ✅ Liste des semaines existantes (pour dropdown)
    public function getWeeks(): array
    {
        $req = $this->bdd->prepare("
            SELECT YEARWEEK(DateVente, 1) AS Semaine
            FROM vente
            GROUP BY YEARWEEK(DateVente, 1)
            ORDER BY Semaine DESC
        ");
        $req->execute();
        return $req->fetchAll();
    }

    // ✅ Stats par semaine pour TOUS les employés
    public function getStatsEmployesByWeek(int $semaine): array
    {
        $req = $this->bdd->prepare("
            SELECT
                u.ID AS ID_Employe,
                u.Nom,
                u.Prenom,
                COUNT(ve.ID) AS NbVentes,
                SUM(ve.PrixVente) AS CA,
                SUM(v.PrixCatalogue) AS TotalBase,
                SUM(ve.PrixVente - v.PrixCatalogue) AS BeneficeReel
            FROM vente ve
            INNER JOIN utilisateur u ON ve.ID_Employe = u.ID
            INNER JOIN vehicule v ON ve.ID_Vehicule = v.ID
            WHERE YEARWEEK(ve.DateVente, 1) = :semaine
            GROUP BY u.ID, u.Nom, u.Prenom
            ORDER BY CA DESC
        ");
        $req->bindParam(':semaine', $semaine, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll();
    }

    public function create($data)
    {
        $req = $this->bdd->prepare("
            INSERT INTO vente 
                (ID_Employe, ID_Vehicule, NomClient, DateVente, PrixVente)
            VALUES 
                (:ID_Employe, :ID_Vehicule, :NomClient, :DateVente, :PrixVente)
        ");

        $req->bindParam(':ID_Employe', $data['ID_Employe'], PDO::PARAM_INT);
        $req->bindParam(':ID_Vehicule', $data['ID_Vehicule'], PDO::PARAM_INT);
        $req->bindParam(':NomClient', $data['NomClient'], PDO::PARAM_STR);
        $req->bindParam(':DateVente', $data['DateVente']);
        $req->bindParam(':PrixVente', $data['PrixVente']);

        $req->execute();
        return $this->bdd->lastInsertId();
    }

    public function update($id, $data)
    {
        $req = $this->bdd->prepare("
            UPDATE vente
            SET 
                ID_Vehicule = :ID_Vehicule,
                NomClient   = :NomClient,
                DateVente   = :DateVente,
                PrixVente   = :PrixVente
            WHERE ID = :ID
        ");

        $req->bindParam(':ID_Vehicule', $data['ID_Vehicule'], PDO::PARAM_INT);
        $req->bindParam(':NomClient', $data['NomClient'], PDO::PARAM_STR);
        $req->bindParam(':DateVente', $data['DateVente']);
        $req->bindParam(':PrixVente', $data['PrixVente']);
        $req->bindParam(':ID', $id, PDO::PARAM_INT);

        return $req->execute();
    }

    public function delete($id)
    {
        $req = $this->bdd->prepare("DELETE FROM vente WHERE ID = :id");
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        return $req->execute();
    }

}

?>