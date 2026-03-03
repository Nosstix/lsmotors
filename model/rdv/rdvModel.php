<?php
/**
 * Model RDV
 * - Persiste les demandes de RDV (panier -> demande)
 * - Tables: rdv, rdv_item
 */
class Rdv
{
    private PDO $bdd;

    public function __construct(PDO $bdd)
    {
        $this->bdd = $bdd;
    }

    /* =========================
       CRÉATION
    ========================= */

    public function createRdv(int $idClient): int
    {
        $req = $this->bdd->prepare("INSERT INTO rdv (ID_Client) VALUES (:idClient)");
        $req->execute([':idClient' => $idClient]);
        return (int)$this->bdd->lastInsertId();
    }

    public function addItem(int $idRdv, int $idVehicule, int $quantite, float $prixUnitaire): void
    {
        $req = $this->bdd->prepare("
            INSERT INTO rdv_item (ID_RDV, ID_Vehicule, Quantite, PrixUnitaire)
            VALUES (:idRdv, :idVehicule, :qte, :prix)
        ");
        $req->execute([
            ':idRdv' => $idRdv,
            ':idVehicule' => $idVehicule,
            ':qte' => $quantite,
            ':prix' => $prixUnitaire
        ]);
    }

    /* =========================
       LISTES
    ========================= */

    public function getDemandes(): array
    {
        $req = $this->bdd->query("
            SELECT r.*, u.DiscordPseudo AS ClientDiscord
            FROM rdv r
            JOIN utilisateur u ON u.ID = r.ID_Client
            WHERE r.Statut = 'demande'
            ORDER BY r.DateCreation ASC
        ");
        return $req->fetchAll();
    }

    public function getEnCoursByEmploye(int $idEmploye): array
    {
        $req = $this->bdd->prepare("
            SELECT r.*, u.DiscordPseudo AS ClientDiscord
            FROM rdv r
            JOIN utilisateur u ON u.ID = r.ID_Client
            WHERE r.Statut = 'en_cours' AND r.ID_Employe = :idEmp
            ORDER BY r.DateMaj DESC
        ");
        $req->execute([':idEmp' => $idEmploye]);
        return $req->fetchAll();
    }

    public function getHistoriqueByClient(int $idClient): array
    {
        $req = $this->bdd->prepare("
            SELECT r.*, e.DiscordPseudo AS EmployeDiscord
            FROM rdv r
            LEFT JOIN utilisateur e ON e.ID = r.ID_Employe
            WHERE r.ID_Client = :idClient AND r.Statut = 'valide'
            ORDER BY r.DateMaj DESC
        ");
        $req->execute([':idClient' => $idClient]);
        return $req->fetchAll();
    }

    public function getHistoriqueByEmploye(int $idEmploye): array
    {
        $req = $this->bdd->prepare("
            SELECT r.*, u.DiscordPseudo AS ClientDiscord
            FROM rdv r
            JOIN utilisateur u ON u.ID = r.ID_Client
            WHERE r.ID_Employe = :idEmp AND r.Statut = 'valide'
            ORDER BY r.DateMaj DESC
        ");
        $req->execute([':idEmp' => $idEmploye]);
        return $req->fetchAll();
    }

    public function getById(int $idRdv): ?array
    {
        $req = $this->bdd->prepare("SELECT * FROM rdv WHERE ID = :id");
        $req->execute([':id' => $idRdv]);
        $row = $req->fetch();
        return $row ?: null;
    }

    public function getItems(int $idRdv): array
    {
        $req = $this->bdd->prepare("
            SELECT i.*, v.NomModele, m.Nom AS MarqueNom
            FROM rdv_item i
            JOIN vehicule v ON v.ID = i.ID_Vehicule
            JOIN marque m ON m.ID = v.ID_Marque
            WHERE i.ID_RDV = :id
            ORDER BY m.Nom, v.NomModele
        ");
        $req->execute([':id' => $idRdv]);
        return $req->fetchAll();
    }

    /* =========================
       WORKFLOW EMPLOYÉ
    ========================= */

    public function prendre(int $idRdv, int $idEmploye): bool
    {
        // Prendre un rdv seulement si encore en 'demande'
        $req = $this->bdd->prepare("
            UPDATE rdv
            SET ID_Employe = :idEmp, Statut = 'en_cours'
            WHERE ID = :idRdv AND Statut = 'demande'
        ");
        $req->execute([':idEmp' => $idEmploye, ':idRdv' => $idRdv]);
        return $req->rowCount() > 0;
    }

    public function remettreGlobal(int $idRdv, int $idEmploye): bool
    {
        // Remettre global seulement si c'est le même employé
        $req = $this->bdd->prepare("
            UPDATE rdv
            SET ID_Employe = NULL, Statut = 'demande'
            WHERE ID = :idRdv AND Statut = 'en_cours' AND ID_Employe = :idEmp
        ");
        $req->execute([':idRdv' => $idRdv, ':idEmp' => $idEmploye]);
        return $req->rowCount() > 0;
    }

    public function valider(int $idRdv, int $idEmploye): bool
    {
        $req = $this->bdd->prepare("
            UPDATE rdv
            SET Statut = 'valide'
            WHERE ID = :idRdv AND Statut = 'en_cours' AND ID_Employe = :idEmp
        ");
        $req->execute([':idRdv' => $idRdv, ':idEmp' => $idEmploye]);
        return $req->rowCount() > 0;
    }

    public function annuler(int $idRdv, int $idEmploye): bool
    {
        $req = $this->bdd->prepare("
            UPDATE rdv
            SET Statut = 'annule'
            WHERE ID = :idRdv AND Statut = 'en_cours' AND ID_Employe = :idEmp
        ");
        $req->execute([':idRdv' => $idRdv, ':idEmp' => $idEmploye]);
        return $req->rowCount() > 0;
    }
}
?>
