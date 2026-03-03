<?php
/**
 * CONTROLLER VENTE - création
 *
 * Objectif:
 * - Empêcher une vente si le client n'existe pas
 * - Ici: le "client" = DiscordPseudo d'un utilisateur en base
 *
 * Entrée:
 * - $data = ['ID_Employe', 'ID_Vehicule', 'NomClient', 'DateVente', 'PrixVente']
 *
 * Sortie:
 * - ID vente créée, ou 0 si refus
 */
function venteInsert(PDO $bdd, array $data): int
{
    /**
     * BLOC 1: lecture + validation pseudo
     */
    $nomClient = trim($data['NomClient'] ?? '');
    if ($nomClient === '') return 0;

    /**
     * BLOC 2: vérif pseudo existant (DiscordPseudo)
     * - Si pseudo inconnu => refus
     */
    $u = new Utilisateur($bdd);
    if (!$u->discordPseudoExists($nomClient)) {
        return 0;
    }

    /**
     * BLOC 3: création vente via model
     */
    $model = new Vente($bdd);
    return $model->create($data);
}