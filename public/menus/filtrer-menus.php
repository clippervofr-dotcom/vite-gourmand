<?php

use Controllers\MenuController;
use Repositories\MenuRepositoryMysql;

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

$menus = $menuController->filtrerMenus($themes, $regimes, $allergenes, $prixMin, $prixMax, $nbrPersonnes);

echo json_encode($menus);