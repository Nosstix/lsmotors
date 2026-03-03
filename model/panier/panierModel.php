<?php
/**
 * Model Panier (session)
 * - Pas de DB ici: c'est juste la structure du panier en session
 * - Format: $_SESSION['panier'][<vehiculeId>] = ['quantite' => int]
 */

function panierInit(): void
{
    if (!isset($_SESSION['panier']) || !is_array($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }
}

function panierGet(): array
{
    panierInit();
    return $_SESSION['panier'];
}

function panierAdd(int $vehiculeId, int $qty = 1): void
{
    panierInit();
    if ($vehiculeId <= 0) return;

    if (!isset($_SESSION['panier'][$vehiculeId])) {
        $_SESSION['panier'][$vehiculeId] = ['quantite' => 0];
    }
    $_SESSION['panier'][$vehiculeId]['quantite'] += max(1, $qty);
}

function panierSetQty(int $vehiculeId, int $qty): void
{
    panierInit();
    if ($vehiculeId <= 0) return;

    if ($qty <= 0) {
        unset($_SESSION['panier'][$vehiculeId]);
        return;
    }
    $_SESSION['panier'][$vehiculeId] = ['quantite' => $qty];
}

function panierRemove(int $vehiculeId): void
{
    panierInit();
    unset($_SESSION['panier'][$vehiculeId]);
}

function panierClear(): void
{
    $_SESSION['panier'] = [];
}
?>
