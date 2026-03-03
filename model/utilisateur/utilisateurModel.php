<?php
/**
 * Model Utilisateur
 * - Accès DB à la table `utilisateur`
 * - Centralise toutes les requêtes SQL liées aux comptes (admin / employe / joueur)
 */
class Utilisateur
{
    /** @var PDO */
    private $bdd;

    public function __construct(PDO $bdd)
    {
        $this->bdd = $bdd;
    }

    /* =========================
       LECTURE
    ========================= */

    /** Récupérer tous les utilisateurs (tri alpha) */
    public function getAll(): array
    {
        $req = $this->bdd->prepare("SELECT * FROM utilisateur ORDER BY Nom ASC, Prenom ASC");
        $req->execute();
        return $req->fetchAll();
    }

    /** Récupérer un utilisateur par ID */
    public function getById(int $id): ?array
    {
        $req = $this->bdd->prepare("SELECT * FROM utilisateur WHERE ID = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $row = $req->fetch();
        return $row ?: null;
    }

    /** Récupérer un utilisateur par Email (utilisé pour la connexion) */
    public function getByEmail(string $email): ?array
    {
        $req = $this->bdd->prepare("SELECT * FROM utilisateur WHERE Email = :email");
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->execute();
        $row = $req->fetch();
        return $row ?: null;
    }

    /** Vérifier l'existence d'un DiscordPseudo (utile pour la vente) */
    public function discordPseudoExists(string $discordPseudo): bool
    {
        $req = $this->bdd->prepare("
            SELECT COUNT(*) 
            FROM utilisateur 
            WHERE DiscordPseudo = :p
        ");
        $req->execute([':p' => $discordPseudo]);
        return ((int)$req->fetchColumn()) > 0;
    }

    /** Liste des DiscordPseudo (pour les datalist) */
    public function getAllDiscordPseudos(): array
    {
        $req = $this->bdd->query("
            SELECT DISTINCT DiscordPseudo
            FROM utilisateur
            WHERE DiscordPseudo IS NOT NULL AND DiscordPseudo <> ''
            ORDER BY DiscordPseudo ASC
        ");
        return $req->fetchAll(PDO::FETCH_COLUMN);
    }

    /* =========================
       ÉCRITURE
    ========================= */

    /**
     * Créer un nouvel utilisateur
     * $data attendu:
     * - Nom, Prenom, Email, Passwrd, Role, DiscordPseudo (optionnel)
     */
    public function create(array $data): int
    {
        $req = $this->bdd->prepare("
            INSERT INTO utilisateur (Nom, Prenom, Email, Passwrd, Role, DiscordPseudo)
            VALUES (:Nom, :Prenom, :Email, :Passwrd, :Role, :DiscordPseudo)
        ");

        $req->bindValue(':Nom', $data['Nom'], PDO::PARAM_STR);
        $req->bindValue(':Prenom', $data['Prenom'], PDO::PARAM_STR);
        $req->bindValue(':Email', $data['Email'], PDO::PARAM_STR);
        $req->bindValue(':Passwrd', $data['Passwrd'], PDO::PARAM_STR);
        $req->bindValue(':Role', $data['Role'], PDO::PARAM_STR);
        $req->bindValue(':DiscordPseudo', $data['DiscordPseudo'] ?? null, PDO::PARAM_STR);

        $req->execute();
        return (int)$this->bdd->lastInsertId();
    }

    /**
     * Mettre à jour un utilisateur
     * - Passwrd optionnel
     * - DiscordPseudo optionnel
     */
    public function update(int $id, array $data): bool
    {
        // Bloc: construction SQL (passwrd optionnel)
        $sql = "UPDATE utilisateur SET Nom = :Nom, Prenom = :Prenom, Email = :Email, Role = :Role, DiscordPseudo = :DiscordPseudo";
        if (isset($data['Passwrd']) && $data['Passwrd'] !== '') {
            $sql .= ", Passwrd = :Passwrd";
        }
        $sql .= " WHERE ID = :ID";

        $req = $this->bdd->prepare($sql);

        // Bloc: bindings obligatoires
        $req->bindValue(':Nom', $data['Nom'], PDO::PARAM_STR);
        $req->bindValue(':Prenom', $data['Prenom'], PDO::PARAM_STR);
        $req->bindValue(':Email', $data['Email'], PDO::PARAM_STR);
        $req->bindValue(':Role', $data['Role'], PDO::PARAM_STR);
        $req->bindValue(':DiscordPseudo', $data['DiscordPseudo'] ?? null, PDO::PARAM_STR);
        $req->bindValue(':ID', $id, PDO::PARAM_INT);

        // Bloc: binding passwrd si fourni
        if (isset($data['Passwrd']) && $data['Passwrd'] !== '') {
            $req->bindValue(':Passwrd', $data['Passwrd'], PDO::PARAM_STR);
        }

        return $req->execute();
    }

    /** Supprimer un utilisateur */
    public function delete(int $id): bool
    {
        $req = $this->bdd->prepare("DELETE FROM utilisateur WHERE ID = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        return $req->execute();
    }
}
?>
