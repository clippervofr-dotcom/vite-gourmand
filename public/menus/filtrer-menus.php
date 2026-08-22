<?php

use Controllers\MenuController;
use Controllers\PlatController;
use Repositories\AllergeneRepositoryMysql;
use Repositories\MenuRepositoryMysql;
use Repositories\PlatRepositoryMysql;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../src/Config/bootstrap.php';
header('Content-Type: application/json');

$themes = $_GET['themes'] ?? [];
$regimes = $_GET['regimes'] ?? [];
$allergenes = $_GET['allergenes'] ?? [];

$prixMin = isset($_GET['prixMin']) ? (float)$_GET['prixMin'] : null;
$prixMax = isset($_GET['prixMax']) ? (float)$_GET['prixMax'] : null;

$nbrPersonnes = isset($_GET['nbrPersonnes']) ? (int)$_GET['nbrPersonnes'] : null;

$menuRepository = new MenuRepositoryMysql($pdo);
$menuController = new MenuController($menuRepository);
$platRepository = new PlatRepositoryMysql($pdo);
$platController = new PlatController($platRepository);
$allergeneRepository = new AllergeneRepositoryMysql($pdo);

$menus = $menuController->filtrerMenus($themes, $regimes, $allergenes, $prixMin, $prixMax, $nbrPersonnes);
$detailsMenu = [];
foreach ($menus as $menu) {
    $plats = $platController->getPlatsByMenuId((int)$menu['menu_id']);
    $allergeneNom = [];
    foreach ($plats as $plat) {
        $allergenes = $platController->getAllergenesByPlatId((int)$plat->getPlatId());
        foreach ($allergenes as $allergene) {
            if (!in_array($allergene->getLibelle(), $allergeneNom)) {
                $allergeneNom[] = $allergene->getLibelle();
            }
        }
    }

    $detailsMenu[] = [
        'menu_id' => $menu['menu_id'],
        'titre' => $menu['titre'],
        'description_menu' => $menu['description_menu'],
        'nombre_personne_minimum' => $menu['nombre_personne_minimum'],
        'prix_par_personne' => $menu['prix_par_personne'],
        'conditions' => $menu['conditions'],
        'quantite_restante' => $menu['quantite_restante'],
        'image_url' => $menu['image_url'],
        'actif' => $menu['actif'],
        'plats' => $plats,
        'allergenes' => $allergeneNom
    ];
}


echo json_encode($detailsMenu);

