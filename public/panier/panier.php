<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../src/Config/bootstrap.php';
require_once ROOT_PATH . '/src/Config/session.php';
require ROOT_PATH . '/src/Security/csrf.php';

use Controllers\MenuController;
use Repositories\ImageMenuRepositoryMysql;
use Repositories\MenuRepositoryMysql;
use Services\TarificationService;

;
header('Content-Type: application/json');


if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifierCsrf();

    //supp la ligne du panier
    if (isset($_POST['action']) && $_POST['action'] === 'supprimer') {
        $uniqueId = $_POST['unique_id'] ?? null;

        $_SESSION['panier'] = array_filter($_SESSION['panier'], function ($item) use ($uniqueId) {
            return $item['uniqueId'] !== $uniqueId;
        });

        $_SESSION['panier'] = array_values($_SESSION['panier']);

        echo json_encode(['success' => true, 'panier' => $_SESSION['panier']]);
        exit;
    }

    //modif la quantité
    if (isset($_POST['action']) && $_POST['action'] === 'modifier') {
        $uniqueId = $_POST['unique_id'] ?? null;
        $nouvelleQuantite = $_POST['quantite'] ?? null;

        foreach ($_SESSION['panier'] as &$item) {
            if ($item['uniqueId'] === $uniqueId) {
                $nouvelleQuantite = max($item['nombre_personne_minimum'], (int)$nouvelleQuantite);
                $item['quantite'] = (int)$nouvelleQuantite;
                $item['prix_total'] = TarificationService::appliquerReduction((int)$nouvelleQuantite, $item['nombre_personne_minimum'], $item['prix_par_personne']);
            }
        }
        unset($item);

        echo json_encode(['success' => true, 'panier' => $_SESSION['panier']]);
        exit;
    }

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
    if ($nouvelleQuantite > $menu->getQuantiteRestante()) {
        echo json_encode(['success' => false, 'message' => 'Quantité demandée dépasse la quantité disponible.']);
        exit;
    }

    $prixTotal = TarificationService::appliquerReduction((int)$nouvelleQuantite, $menu->getNombrePersonneMinimum(), $menu->getPrixParPersonne());

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
