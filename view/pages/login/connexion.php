<?php
/**
 * VIEW - Connexion
 * - Bloc traitement: vérifie les champs, appelle utilisateurLogin(), met la session
 * - Bloc affichage: formulaire + erreurs + lien inscription
 */

// Bloc: traitement du formulaire de connexion
$erreur = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnConnexion'])) {

    $email    = trim($_POST['email'] ?? '');
    $passwrd  = $_POST['passwrd'] ?? '';

    if ($email !== '' && $passwrd !== '') {

        // Appel controller
        $user = utilisateurLogin($bdd, $email, $passwrd);

        if ($user) {
            // Bloc: session
            $_SESSION['utilisateur'] = [
                'ID'            => $user['ID'],
                'Nom'           => $user['Nom'],
                'Prenom'        => $user['Prenom'],
                'Email'         => $user['Email'],
                'Role'          => $user['Role'],
                'DiscordPseudo' => $user['DiscordPseudo'] ?? null,
            ];

            // Bloc: redirection selon rôle
            if ($user['Role'] === 'admin') {
                header("Location: index.php?page=admin");
            } elseif ($user['Role'] === 'employe') {
                header("Location: index.php?page=rdv_demandes");
            } else {
                header("Location: index.php?page=accueil");
            }
            exit;

        } else {
            $erreur = "Email ou mot de passe incorrect.";
        }

    } else {
        $erreur = "Veuillez remplir tous les champs.";
    }
}
?>

<h1 class="mb-4">Connexion</h1>

<?php if ($erreur !== ""): ?>
<div class="alert alert-danger">
    <?php echo htmlspecialchars($erreur); ?>
</div>
<?php endif; ?>

<!-- Bloc: formulaire -->
<form method="post" action="index.php?page=connexion" class="mt-3" style="max-width:400px;">
    <div class="mb-3">
        <label for="email" class="form-label">Adresse email</label>
        <input type="email" class="form-control" id="email" name="email" required
               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
    </div>

    <div class="mb-3">
        <label for="passwrd" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="passwrd" name="passwrd" required>
    </div>

    <button type="submit" name="btnConnexion" class="btn btn-primary w-100">Se connecter</button>

    <!-- Bloc: lien inscription -->
    <a class="btn btn-outline-light w-100 mt-2" href="index.php?page=inscription">Créer un compte joueur</a>
</form>
