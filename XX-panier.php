<?php
session_start();

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $menuId = $_POST['menu_id'] ?? null;
    $quantite = $_POST['quantite'] ?? null;

    if (!$menuId || !$quantite) {
        echo json_encode(['success' => false, 'message' => 'Données manquantes.']);
        exit;
    }


    $_SESSION['panier'][] = [
        'uniqueId' => uniqid(),
        'menu_id' => $menuId,
        'quantite' => $quantite
    ];

    echo json_encode(['success' => true, 'panier' => $_SESSION['panier']]);
    exit;


}

echo json_encode($_SESSION['panier']);