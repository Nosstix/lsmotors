<?php
/**
 * VIEW - Mon profil (client)
 * - Affiche les infos du compte client
 * - Affiche stats: nombre de RDV validés + total dépensé
 */

$user = $_SESSION['utilisateur'] ?? [];
$idClient = (int)($user['ID'] ?? 0);

$stats = rdvGetClientStats($bdd, $idClient);
$nbRdv = (int)($stats['nb_rdv'] ?? 0);
$total = (float)($stats['total_depense'] ?? 0);
?>

<div class="row g-4">
    <div class="col-12 col-lg-6">
        <div class="card bg-secondary text-light h-100">
            <div class="card-body">
                <h3 class="card-title mb-3">Mon profil</h3>

                <div class="mb-2"><span class="text-secondary">Nom :</span>
                    <span class="text-light"><?php echo htmlspecialchars(($user['Nom'] ?? '') . ' ' . ($user['Prenom'] ?? '')); ?></span>
                </div>

                <div class="mb-2"><span class="text-secondary">Email :</span>
                    <span class="text-light"><?php echo htmlspecialchars($user['Email'] ?? ''); ?></span>
                </div>

                <div class="mb-2"><span class="text-secondary">Pseudo Discord :</span>
                    <span class="text-light"><?php echo htmlspecialchars($user['DiscordPseudo'] ?? ''); ?></span>
                </div>

                <div class="mb-2"><span class="text-secondary">Rôle :</span>
                    <span class="badge bg-success">Client</span>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <a class="btn btn-outline-light" href="index.php?page=rdv">Panier / RDV</a>
                    <a class="btn btn-outline-light" href="index.php?page=achats">Mes achats</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6">
        <div class="card bg-secondary text-light h-100">
            <div class="card-body">
                <h3 class="card-title mb-3">Mes statistiques</h3>

                <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-dark">
                    <span>RDV déjà pris (validés)</span>
                    <span class="fw-bold"><?php echo $nbRdv; ?></span>
                </div>

                <div class="d-flex justify-content-between align-items-center py-2">
                    <span>Total dépensé</span>
                    <span class="fw-bold"><?php echo number_format($total, 0, ',', ' '); ?> $</span>
                </div>

                <div class="alert alert-dark mt-4 mb-0">
                    Ces stats se basent sur les RDV <strong>validés</strong> (historique).
                </div>
            </div>
        </div>
    </div>
</div>
