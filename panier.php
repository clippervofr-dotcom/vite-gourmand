<?php
session_start();

use Controllers\MenuController;
use includes\Autoloader;
use Repositories\ImageMenuRepositoryMysql;
use Repositories\MenuRepositoryMysql;


require __DIR__ . '/includes/Autoloader.php';
require __DIR__ . '/Bootstraps/bootstrap-db.php';
Autoloader::register();
header('Content-Type: application/json');


if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

//supp la ligne du panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'supprimer') {
    $uniqueId = $_POST['unique_id'] ?? null;

    $_SESSION['panier'] = array_filter($_SESSION['panier'], function ($item) use ($uniqueId) {
        return $item['uniqueId'] !== $uniqueId;
    });

    $_SESSION['panier'] = array_values($_SESSION['panier']);

    echo json_encode(['success' => true, 'panier' => $_SESSION['panier']]);
    exit;
}

//modif la quantité
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'modifier') {
    $uniqueId = $_POST['unique_id'] ?? null;
    $nouvelleQuantite = $_POST['quantite'] ?? null;

    foreach ($_SESSION['panier'] as &$item) {
        if ($item['uniqueId'] === $uniqueId) {
            $nouvelleQuantite = max($item['nombre_personne_minimum'], (int)$nouvelleQuantite);
            $item['quantite'] = (int)$nouvelleQuantite;
            $item['prix_total'] = $item['prix_par_personne'] * (int)$nouvelleQuantite;
        }
    }
    unset($item);

    echo json_encode(['success' => true, 'panier' => $_SESSION['panier']]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $menuId = $_POST['menu_id'] ?? null;
    $quantite = $_POST['quantite'] ?? null;

    if (!$menuId || !is_numeric($quantite) || (int)$quantite <= 0) {
        echo json_encode(['success' => false, 'message' => 'Données invalide.']);
        exit;
    }

    $menuRepository = new MenuRepositoryMysql($pdo);
    $imageMenuRepository = new ImageMenuRepositoryMysql($pdo);
    $menuController = new MenuController($menuRepository);

    $menu = $menuController->getMenuById((int)$menuId);
    if (!$menu) {
        echo json_encode(['success' => false, 'message' => 'Menu introuvable.']);
        exit;
    }

    $imageMenu = $imageMenuRepository->getByMenuId($menu->getId());
    if (!$imageMenu) {
        error_log('Image introuvable pour le menu ID: ' . $menu->getId());
    }

    $nouvelleQuantite = max($menu->getNombrePersonneMinimum(), (int)$quantite);
    $prixTotal = $menu->getPrixParPersonne() * (int)$nouvelleQuantite;

    $_SESSION['panier'][] = [
        'uniqueId' => uniqid(),
        'menu_id' => $menu->getId(),
        'titre' => $menu->getTitre(),
        'quantite' => (int)$nouvelleQuantite,
        'description' => $menu->getDescriptionMenu(),
        'conditions' => $menu->getConditions(),
        'prix_par_personne' => $menu->getPrixParPersonne(),
        'prix_total' => $prixTotal,
        'nombre_personne_minimum' => $menu->getNombrePersonneMinimum(),
        'image_url' => $imageMenu ? $imageMenu->getUrlImage() : null
    ];

    echo json_encode(['success' => true, 'panier' => $_SESSION['panier']]);
    exit;
}

echo json_encode($_SESSION['panier']);
