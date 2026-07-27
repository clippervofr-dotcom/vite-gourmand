<?php
require 'includes/db.php';

header('Content-Type: application/json');

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

    $menu = $pdo->prepare("SELECT menu.*, image_menu.url AS image_url FROM menu JOIN image_menu ON menu.menu_id = image_menu.menu_id WHERE menu.menu_id = ?");
    $menu->execute([$menuId]);
    $resultats = $menu->fetch();

    echo json_encode($resultats);

    $resultats['prix_total'] = $resultats['prix_par_personne'] * $quantite;

    $_SESSION['panier'][] = [
        'uniqueId' => uniqid(),
        'menu_id' => $menuId,
        'quantite' => $quantite,
        'titre' => $resultats['titre'] ?? null,
        'description' => $resultats['description_menu'] ?? null,
        'prix_par_personne' => $resultats['prix_par_personne'] ?? null,
        'nombre_personne_minimum' => $resultats['nombre_personne_minimum'] ?? null,
        'conditions' => $resultats['conditions'] ?? null,
        'image_url' => $resultats['image_url'] ?? null,
        'prix_total' => $resultats['prix_total'] ?? null,
    ];

    echo json_encode(['success' => true, 'panier' => $_SESSION['panier']]);
    exit;
}

echo json_encode($_SESSION['panier']);
