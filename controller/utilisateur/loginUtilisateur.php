<?php

// Fonction de connexion : retourne l'utilisateur si OK, sinon null
function utilisateurLogin(PDO $bdd, string $email, string $password): ?array
{
    $model = new Utilisateur($bdd);

    // Récupérer l'utilisateur par email
    $user = $model->getByEmail($email);

    if (!$user) {
        throw new Exception("Aucun utilisateur trouvé.");
    }

    if (!empty($user['verrouille_jusqua'])){
        $heureActuelle = new DateTime();
        $heureDeblocage = new DateTime($user['verrouille_jusqua']);

        if ($heureActuelle < $heureDeblocage){
            $interval = $heureActuelle->diff($heureDeblocage);
            throw new Exception("Compte verrouillé. Réessayez dans " . $interval->format('% %s secondes') . ".");
        } else {
            $model->reinitialiserTentatives((int)$user['ID']);
            $user['tentatives_echouees'] = 0;
        }
    }
    $hash = $user['Passwrd'];
    $ok = false;

    if (password_verify($password, $hash)){
        $ok = true;
    }
    if ($ok){
        if (password_needs_rehash($hash, PASSWORD_ARGON2ID) || $password === $hash){
            $nouveauHash = password_hash($password, PASSWORD_ARGON2ID);

            $req = $bdd->prepare("UPDATE utilisateur SET Passwrd = :hash WHERE ID = :id");
            $req->execute([
                ':hash' => $nouveauHash,
                ':id' => (int)$user['ID']
            ]);
        }
        $model->reinitialiserTentatives((int)$user['ID']);
        return $user;
    } else {
        $tentatives = 0;
        if (isset($user['tentatives_echouees'])){
            $tentatives = (int)$user['tentatives_echouees'];
        }
        $tentatives++;
        $model->gererEchecConnexion((int)$user['ID'], $tentatives);
        if ($tentatives >= 3){
            throw new Exception("Mot de passe incorrect. Compte verrouillé pour 15 secondes.");
        } else {
            throw new Exception("Mot de passe incorrect. Il vous reste " . (3 - $tentatives) . " tentative(s).");
        }
        // $tentativesActuelle = (int)($user['tentatives_echouees'] ?? 0);
        // $model->gererEchecConnexion((int)$user['ID'], $tentativesActuelle);
        // $tentativesRestantes = 2 - ($tentativesActuelle + 1);
        // if ($tentativesRestantes <= 0){
        //     throw new Exception("Mot de passe incorrect. Compte verrouillé pour 15 secondes.");
        // } else {
        //     throw new Exception("Mot de passe incorrect. Il vous reste " . $tentativesRestantes . " tentative(s).");
        // }
    }

}