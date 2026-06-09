<?php
/**
 * Controller Utilisateur - création
 * - Expose des fonctions "faciles" à appeler depuis les views
 * - La logique SQL est dans le Model (Utilisateur)
 */

function utilisateurInsert(PDO $bdd, array $data): int
{
    // Bloc: création générique (admin/employe/joueur) utilisée côté admin
    $model = new Utilisateur($bdd);
    return $model->create($data);
}

/**
 * Inscription publique (uniquement joueur)
 * - Force Role='joueur'
 * - Hash le mot de passe (propre)
 * - Empêche de choisir admin/employe via formulaire
 */
function utilisateurRegisterJoueur(PDO $bdd, array $data): int
{
    $model = new Utilisateur($bdd);

    $payload = [
        'Nom' => $data['Nom'],
        'Prenom' => $data['Prenom'],
        'Email' => $data['Email'],
        'Passwrd' => password_hash($data['Passwrd'], PASSWORD_DEFAULT),
        'Role' => 'joueur',
        'DiscordPseudo' => $data['DiscordPseudo'] ?? null,
    ];

    return $model->create($payload);
}

function validerMotDePasseRegex(string $password): array
{
    $erreurs = [];
    if (strlen($password) < 12) {
        $erreurs[] = "Le mot de passe doit comporter au moins 12 caractères.";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        $erreurs[] = "Le mot de passe doit contenir au moins une lettre majuscule.";
    }
    if (!preg_match('/[a-z]/', $password)) {
        $erreurs[] = "Le mot de passe doit contenir au moins une lettre minuscule.";
    }
    if (!preg_match('/[0-9]/', $password)) {
        $erreurs[] = "Le mot de passe doit contenir au moins un chiffre.";
    }
    if (!preg_match('/[#@$!%*?&]/', $password)) {
        $erreurs[] = "Le mot de passe doit contenir au moins un caractère spécial (@$!%*?&).";
    }
    return $erreurs;
}