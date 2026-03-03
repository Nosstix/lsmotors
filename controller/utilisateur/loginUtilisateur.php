<?php

// Fonction de connexion : retourne l'utilisateur si OK, sinon null
function utilisateurLogin(PDO $bdd, string $email, string $password): ?array
{
    $model = new Utilisateur($bdd);

    // Récupérer l'utilisateur par email
    $user = $model->getByEmail($email);

    if (!$user) {
        return null;
    }

    $hash = $user['Passwrd'];

    // Deux modes :
    // 1) Mot de passe hashé (password_hash)
    // 2) Mot de passe en clair (comme ton admin "admin123" actuel)
    $ok = false;

    if (password_verify($password, $hash)) {
        $ok = true;
    } elseif ($password === $hash) {
        $ok = true;
    }

    if ($ok) {
        return $user;
    }

    return null;
}