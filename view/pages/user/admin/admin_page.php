<?php
if (!isset($_SESSION['utilisateur']) || ($_SESSION['utilisateur']['Role'] ?? '') !== 'admin') {
    echo '<div class="container py-4"><div class="alert alert-danger">Accès refusé.</div></div>';
    return;
}
?>

<div class="container py-5">
    <div class="admin-download-wrap">
        <div class="admin-download-card">
            <h1 class="admin-download-title">Administration LS MOTORS</h1>
            <p class="admin-download-text">
                L’administration du projet se fait via l’application Java dédiée.
            </p>
            <p class="admin-download-text">
                Télécharge-la ici :
            </p>

            <a class="admin-download-btn" href="https://github.com/Nosstix/PPE-LOURD.git" target="_blank" rel="noopener">
                Télécharger l’application Java (GitHub)
            </a>

            <p class="admin-download-hint">
                Astuce : sur GitHub, clique sur <strong>Code</strong> → <strong>Download ZIP</strong>, ou clone le dépôt.
            </p>
        </div>
    </div>
</div>
