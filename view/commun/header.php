<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LS MOTORS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="view/public/css/style.css">
    <?php
    if (isset($page)) {
        $cssPath = __DIR__ . "/../public/css/pages/{$page}.css";
        if (file_exists($cssPath)) {
            echo '<link rel="stylesheet" href="view/public/css/pages/' . htmlspecialchars($page) . '.css">';
        }
    }
    ?>
</head>

<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-warning">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center gap-2" href="index.php?page=accueil">
                <img
                    id="siteLogo"
                    src="view/public/img/logo.png"
                    data-logo-dark="view/public/img/logo.png"
                    data-logo-light="view/public/img/logoWhite.png"
                    alt="LS MOTORS"
                    style="height:32px;">
                <span class="fw-bold">LS MOTORS</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
                aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="index.php?page=accueil">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?page=categories">Catégories</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?page=contact">Nous contacter</a></li>
                </ul>

                <!-- Barre de recherche (centre) -->
                <form class="d-flex mx-lg-auto my-0 align-items-center"
                      role="search"
                      method="get"
                      action="index.php"
                      style="max-width:520px; width:100%;">

                    <input type="hidden" name="page" value="listeVehicules">

                    <?php if (!empty($_GET['id_categorie'])): ?>
                        <input type="hidden" name="id_categorie" value="<?php echo (int)$_GET['id_categorie']; ?>">
                    <?php endif; ?>

                    <div class="nav-search-wrap">
                        <input
                            id="navSearchInput"
                            class="form-control nav-search-input"
                            type="search"
                            name="q"
                            placeholder="Quel véhicule cherchez-vous ?"
                            aria-label="Rechercher un véhicule"
                            autocomplete="off"
                            value="<?php echo htmlspecialchars($_GET['q'] ?? ''); ?>"
                        >
                        <div id="navSearchDropdown" class="nav-search-dropdown d-none"></div>
                    </div>

                    <button class="btn btn-outline-warning ms-2" type="submit">Rechercher</button>
                </form>
            </div>


            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-lg-2">
    <?php if (isset($_SESSION['utilisateur'])): ?>
        <li class="nav-item text-secondary">
            Bonjour, <span class="text-light"><?php echo htmlspecialchars($_SESSION['utilisateur']['Prenom'] ?? ''); ?></span>
            <?php
                $r = $_SESSION['utilisateur']['Role'] ?? 'joueur';
                if ($r === 'admin') {
                    echo ' <span class="badge bg-danger">Admin</span>';
                } elseif ($r === 'employe') {
                    echo ' <span class="badge bg-primary">Employé</span>';
                } else {
                    echo ' <span class="badge bg-success">Client</span>';
                }
            ?>
        </li>

        <!-- Thème -->
        <li class="nav-item dropdown dropdown-hover">
            <a class="nav-link dropdown-toggle theme-btn" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Thème
            </a>
            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                <li><button class="dropdown-item" type="button" data-theme="dark">Thème sombre</button></li>
                <li><button class="dropdown-item" type="button" data-theme="light">Thème clair</button></li>
            </ul>
        </li>

        <?php if (($_SESSION['utilisateur']['Role'] ?? '') === 'admin' || ($_SESSION['utilisateur']['Role'] ?? '') === 'employe'): ?>
            <li class="nav-item dropdown dropdown-hover">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Ventes
                </a>
                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                    <li><a class="dropdown-item" href="index.php?page=ventes_ajouter">Ajouter une vente</a></li>
                    <li><a class="dropdown-item" href="index.php?page=ventes_historique">Historique ventes</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="index.php?page=rdv_demandes">Demandes de RDV</a></li>
                    <li><a class="dropdown-item" href="index.php?page=rdv_mes">RDV en cours</a></li>
                    <li><a class="dropdown-item" href="index.php?page=rdv_historique_employe">Mes RDV (historique)</a></li>
                </ul>
            </li>

            <?php if (($_SESSION['utilisateur']['Role'] ?? '') === 'admin'): ?>
                <li class="nav-item"><a class="nav-link" href="index.php?page=admin">Admin</a></li>
            <?php endif; ?>

            <li class="nav-item">
                <a class="btn btn-outline-light btn-sm" href="index.php?page=deconnexion">Déconnexion</a>
            </li>
        <?php else: ?>
            <!-- Profil (client) -->
            <li class="nav-item dropdown dropdown-hover">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Profil
                </a>
                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                    <li><a class="dropdown-item" href="index.php?page=profil">Mon profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="index.php?page=rdv">Panier / RDV</a></li>
                    <li><a class="dropdown-item" href="index.php?page=rdv_client">Mon RDV</a></li>
                    <li><a class="dropdown-item" href="index.php?page=achats">Mes achats</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="index.php?page=deconnexion">Déconnexion</a></li>
                </ul>
            </li>
        <?php endif; ?>

    <?php else: ?>
        <!-- Thème -->
        <li class="nav-item dropdown dropdown-hover">
            <a class="nav-link dropdown-toggle theme-btn" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Thème
            </a>
            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                <li><button class="dropdown-item" type="button" data-theme="dark">Thème sombre</button></li>
                <li><button class="dropdown-item" type="button" data-theme="light">Thème clair</button></li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="btn btn-outline-light btn-sm" href="index.php?page=connexion">Connexion</a>
        </li>
    <?php endif; ?>
</ul>
        </div>
        </div>
    </nav>

    <main class="container py-4 flex-grow-1">