<?php
/**
 * VIEW - Inscription joueur
 * - Bloc traitement: valide les champs, force role joueur, crée en DB
 * - Bloc affichage: formulaire + erreurs / succès
 */

$erreur = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnInscription'])) {
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $discord = trim($_POST['discord'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pass1 = $_POST['pass1'] ?? '';
    $pass2 = $_POST['pass2'] ?? '';

    if ($nom === '' || $prenom === '' || $discord === '' || $email === '' || $pass1 === '' || $pass2 === '') {
        $erreur = "Tous les champs sont obligatoires.";
    } elseif ($pass1 !== $pass2) {
        $erreur = "Les mots de passe ne correspondent pas.";
    } else {
        // Bloc: empêcher doublon email
        $model = new Utilisateur($bdd);
        if ($model->getByEmail($email)) {
            $erreur = "Cet email est déjà utilisé.";
        } else {
            // Bloc: création joueur
            utilisateurRegisterJoueur($bdd, [
                'Nom' => $nom,
                'Prenom' => $prenom,
                'Email' => $email,
                'Passwrd' => $pass1,
                'DiscordPseudo' => $discord
            ]);

            $success = "Compte créé. Tu peux te connecter.";
        }
    }
}
?>

<h1 class="mb-4">Inscription joueur</h1>

<?php if ($erreur !== ""): ?>
<div class="alert alert-danger"><?php echo htmlspecialchars($erreur); ?></div>
<?php endif; ?>

<?php if ($success !== ""): ?>
<div class="alert alert-success">
    <?php echo htmlspecialchars($success); ?>
    <div class="mt-2">
        <a class="btn btn-light btn-sm" href="index.php?page=connexion">Aller à la connexion</a>
    </div>
</div>
<?php endif; ?>

<form method="post" action="index.php?page=inscription" style="max-width:520px;">
    <div class="mb-3">
        <label class="form-label">Nom</label>
        <input class="form-control" name="nom" required value="<?php echo htmlspecialchars($_POST['nom'] ?? ''); ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Prénom</label>
        <input class="form-control" name="prenom" required value="<?php echo htmlspecialchars($_POST['prenom'] ?? ''); ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Pseudo Discord</label>
        <input class="form-control" name="discord" required value="<?php echo htmlspecialchars($_POST['discord'] ?? ''); ?>">
        <div class="form-text text-secondary">Ex: Nosstix_15</div>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Mot de passe</label>
        <input type="password" class="form-control" name="pass1" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Confirmer mot de passe</label>
        <input type="password" class="form-control" name="pass2" required>
    </div>

    <button type="submit" class="btn btn-success" name="btnInscription">Créer mon compte</button>
    <a class="btn btn-outline-light" href="index.php?page=connexion">Retour</a>
</form>
