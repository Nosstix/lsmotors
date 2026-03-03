<?php
/**
 * CONTROLLER PANIER (session)
 *
 * Objectif:
 * - Recevoir les actions de la vue (add/update/remove/clear)
 * - Appeler le model panier (qui manipule la session)
 *
 * Important:
 * - Le controller ne fait PAS de HTML
 * - La vue envoie via POST, le controller applique, puis on redirect
 */

function panierHandleAdd(): void
{
    /**
     * BLOC: ajout panier
     * - vehicule_id: ID véhicule
     * - quantite: quantité souhaitée (par défaut 1)
     */
    $id = (int)($_POST['vehicule_id'] ?? 0);
    $qty = (int)($_POST['quantite'] ?? 1);

    if ($id <= 0) return;
    panierAdd($id, $qty);
}

function panierHandleUpdate(): void
{
    /**
     * BLOC: update quantités
     * - items = tableau [vehiculeId => qty]
     * - qty <= 0 => supprimé par le model
     */
    $items = $_POST['items'] ?? [];
    if (!is_array($items)) return;

    foreach ($items as $vehiculeId => $qty) {
        panierSetQty((int)$vehiculeId, (int)$qty);
    }
}

function panierHandleRemove(): void
{
    /**
     * BLOC: suppression d’un item
     */
    $id = (int)($_POST['vehicule_id'] ?? 0);
    if ($id <= 0) return;
    panierRemove($id);
}

function panierHandleClear(): void
{
    /**
     * BLOC: vider panier
     */
    panierClear();
}