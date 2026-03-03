<?php
/**
 * VIEW - Ajouter une vente (employe/admin)
 *
 * BLOC ACCÈS
 * - Interdit si pas connecté OU si rôle ≠ admin/employe
 *
 * BLOC DONNÉES
 * - Récupère véhicules pour le select
 * - Récupère pseudos Discord existants (datalist)
 *
 * BLOC TRAITEMENT
 * - Appelle venteInsert() (controller) qui vérifie le pseudo discord + crée la vente
 *
 * BLOC AFFICHAGE
 * - Formulaire + encart "tuto vente"
 * - Calculateur remise (JS) : prix client + prix entreprise
 */

if (!isset($_SESSION['utilisateur']) || !in_array($_SESSION['utilisateur']['Role'] ?? '', ['admin', 'employe'], true)) {
    echo '<div class="alert alert-danger">Accès refusé.</div>';
    return;
}

/* =========================
   BLOC DONNÉES (selects)
========================= */
$vehicules = vehiculeSelectAll($bdd);
$pseudosDiscord = (new Utilisateur($bdd))->getAllDiscordPseudos();

/* =========================
   BLOC TRAITEMENT FORMULAIRE
========================= */
$message = "";
$erreur = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'ajouter_vente') {

    $idEmploye = (int)($_SESSION['utilisateur']['ID'] ?? 0);
    $idVehicule = (int)($_POST['vehicule'] ?? 0);
    $nomClient = trim($_POST['nomClient'] ?? '');
    $prixVente = (float)($_POST['prixVente'] ?? 0);

    // dateVente: datetime-local => "YYYY-MM-DDTHH:MM"
    $dateVenteRaw = $_POST['dateVente'] ?? '';
    $dateVente = $dateVenteRaw ? str_replace('T', ' ', $dateVenteRaw) . ':00' : date('Y-m-d H:i:s');

    if ($idVehicule <= 0 || $nomClient === '' || $prixVente <= 0) {
        $erreur = "Veuillez remplir correctement tous les champs.";
    } else {
        // Controller: vérifie pseudo discord existant + crée la vente
        $id = venteInsert($bdd, [
            'ID_Employe' => $idEmploye,
            'ID_Vehicule' => $idVehicule,
            'NomClient' => $nomClient,
            'DateVente' => $dateVente,
            'PrixVente' => $prixVente
        ]);

        if ($id > 0) {
            $message = "Vente ajoutée (#{$id}).";
        } else {
            $erreur = "Vente refusée: le pseudo Discord n'existe pas dans la base.";
        }
    }
}
?>

<h1 class="mb-4">Ajouter une vente</h1>

<?php if ($message): ?>
<div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>

<?php if ($erreur): ?>
<div class="alert alert-danger"><?php echo htmlspecialchars($erreur); ?></div>
<?php endif; ?>

<div class="row g-4">
    <div class="col-lg-7">

        <!-- =========================
             BLOC FORMULAIRE VENTE
        ========================== -->
        <form method="post" action="index.php?page=ventes_ajouter">
            <input type="hidden" name="action" value="ajouter_vente">

            <div class="mb-3">
                <label class="form-label">Véhicule</label>
                <select class="form-select" name="vehicule" id="vehiculeSelect" required>
                    <option value="">-- Choisir --</option>
                    <?php foreach ($vehicules as $v): ?>
                    <option value="<?php echo (int)$v['ID']; ?>" data-prix="<?php echo (float)$v['PrixCatalogue']; ?>">
                        <?php echo htmlspecialchars($v['NomModele']); ?>
                        (<?php echo number_format((float)$v['PrixCatalogue'], 0, ',', ' '); ?> $)
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Pseudo Discord client</label>

                <!-- BLOC: datalist + saisie libre -->
                <input class="form-control" list="discordPseudos" name="nomClient" placeholder="Ex: Nosstix_15"
                    required>
                <datalist id="discordPseudos">
                    <?php foreach ($pseudosDiscord as $p): ?>
                    <option value="<?php echo htmlspecialchars($p); ?>"></option>
                    <?php endforeach; ?>
                </datalist>

                <div class="form-text text-secondary">
                    Tu peux taper, mais ça doit être exactement le pseudo Discord d'un utilisateur existant.
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Prix de vente (réel payé)</label>
                <input type="number" step="0.01" min="0" class="form-control" name="prixVente" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Date de vente</label>
                <input type="datetime-local" class="form-control" name="dateVente"
                    value="<?php echo date('Y-m-d\TH:i'); ?>">
            </div>

            <button class="btn btn-success" type="submit">Enregistrer</button>
        </form>
    </div>

    <div class="col-lg-5">

        <!-- =========================
             BLOC TUTO / RAPPEL
        ========================== -->
        <div class="alert alert-info">
            <h2 class="h5 mb-2">Tuto rapide</h2>
            <ul class="mb-0">
                <li>Choisis le <strong>modèle exact</strong>.</li>
                <li>Le client doit être un <strong>pseudo Discord existant</strong> (sinon refus).</li>
                <li>Renseigne le <strong>prix réel payé</strong> (pas le catalogue).</li>
                <li>Le calculateur sert juste à te guider (remise + prix entreprise).</li>
            </ul>
        </div>

        <!-- =========================
             BLOC CALCULATEUR REMISE
             - Calcul JS (pas de logique PHP)
             - Prix client = PrixCatalogue * (1 - remise%)
             - Prix entreprise = PrixCatalogue * 0.65
        ========================== -->
        <div class="card bg-dark border">
            <div class="card-body">
                <h5 class="card-title">Calculateur remise</h5>

                <div class="mb-3">
                    <label class="form-label">Prix catalogue sélectionné ($)</label>
                    <input type="text" class="form-control" id="calcPrixCatalogue" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">% de réduction (0 à 30%)</label>
                    <input type="number" min="0" max="30" value="0" class="form-control" id="calcRemise">
                    <div class="form-text text-secondary">0 à 30%. On évite les remises “inventées”.</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Prix joueur après remise ($)</label>
                    <input type="text" class="form-control" id="calcPrixJoueur" readonly>
                </div>

                <div class="mb-0">
                    <label class="form-label">Prix entreprise (-35%) ($)</label>
                    <input type="text" class="form-control" id="calcPrixEntreprise" readonly>
                </div>
            </div>
        </div>

        <script>
        /**
         * BLOC JS CALCULATEUR
         * - Lit le prix catalogue depuis l'option sélectionnée
         * - Applique remise (0-30) sur prix joueur
         * - Calcule prix entreprise -35%
         */
        (function() {
            const sel = document.getElementById('vehiculeSelect');
            const outCat = document.getElementById('calcPrixCatalogue');
            const inRemise = document.getElementById('calcRemise');
            const outJoueur = document.getElementById('calcPrixJoueur');
            const outEnt = document.getElementById('calcPrixEntreprise');

            function fmt(n) {
                if (isNaN(n)) return '';
                return Math.round(n).toLocaleString('fr-FR');
            }

            function getPrixCatalogue() {
                const opt = sel.options[sel.selectedIndex];
                const p = opt ? parseFloat(opt.getAttribute('data-prix') || '0') : 0;
                return isNaN(p) ? 0 : p;
            }

            function getRemise() {
                let r = parseFloat(inRemise.value || '0');
                if (isNaN(r)) r = 0;
                if (r < 0) r = 0;
                if (r > 30) r = 30;
                inRemise.value = r;
                return r;
            }

            function refresh() {
                const prix = getPrixCatalogue();
                const remise = getRemise();

                outCat.value = fmt(prix);

                const prixJoueur = prix * (1 - (remise / 100));
                const prixEntreprise = prix * 0.65;

                outJoueur.value = fmt(prixJoueur);
                outEnt.value = fmt(prixEntreprise);
            }

            sel.addEventListener('change', refresh);
            inRemise.addEventListener('input', refresh);
            refresh();
        })();
        </script>

    </div>
</div>