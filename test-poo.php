<?php
use Repositories\HistoriqueStatutRepositoryMysql;
use Repositories\CommandesRepositoryMysql;
use Repositories\MenuRepositoryMysql;
use Repositories\ThemeRepositoryMysql;
use Repositories\RegimeRepositoryMysql;
use Repositories\AllergeneRepositoryMysql;
use Repositories\ImageMenuRepositoryMysql;
use Repositories\UtilisateurRepositoryMysql;
use Repositories\AvisRepositoryMongoDB;
use Controllers\AvisController;
use includes\Autoloader;
require __DIR__ . '/includes/Autoloader.php';
require __DIR__ . '/Bootstraps/bootstrap-db.php';
Autoloader::register();
header('Content-Type: application/json');

// --- Étape 1 : créer les repositories, dans le bon ordre ---
$historiqueRepository = new HistoriqueStatutRepositoryMysql($pdo);
$commandesRepository = new CommandesRepositoryMysql($pdo, $historiqueRepository);
$menuRepository = new MenuRepositoryMysql($pdo);
$themeRepository = new ThemeRepositoryMysql($pdo);
$regimeRepository = new RegimeRepositoryMysql($pdo);
$allergeneRepository = new AllergeneRepositoryMysql($pdo);
$imageMenuRepository = new ImageMenuRepositoryMysql($pdo);
$utilisateurRepository = new UtilisateurRepositoryMysql($pdo);
$avisRepository = new AvisRepositoryMongoDB($manager);
$avisController = new AvisController($avisRepository, $commandesRepository);

// --- Étape 2 : tester une vraie méthode ---
$commande = $commandesRepository->getById(1);
$utilisateur = $utilisateurRepository->getById(1);
$menu = $menuRepository->getById(1);
$theme = $themeRepository->getById(1);
$regime = $regimeRepository->getById(1);
$allergene = $allergeneRepository->getById(1);
$imageMenu = $imageMenuRepository->getById(1);

$resultatsAvis = $avisController->getAllAvis();


echo '<pre>';
print_r($commande);
print_r($utilisateur);
print_r($menu);
print_r($theme);
print_r($regime);
print_r($allergene);
print_r($imageMenu);
print_r($resultatsAvis);
echo '</pre>';

