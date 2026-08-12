<?php
require_once 'bootstrap-db.php';
require_once 'bootstrap-Commandes.php';
require_once 'bootstrap-Historique.php';
require_once 'bootstrap-Utilisateur.php';
require_once 'bootstrap-Role.php';
require_once 'bootstrap-Menu.php';
require_once 'bootstrap-Theme.php';
require_once 'bootstrap-Regime.php';
require_once 'bootstrap-Allergene.php';
require_once 'bootstrap-ImageMenu.php';


// --- Étape 1 : créer les repositories, dans le bon ordre ---
$historiqueRepository = new HistoriqueStatutRepositoryMysql($pdo);
$commandesRepository = new CommandesRepositoryMysql($pdo, $historiqueRepository);
$menuRepository = new MenuRepositoryMysql($pdo);
$themeRepository = new ThemeRepositoryMysql($pdo);
$regimeRepository = new RegimeRepositoryMysql($pdo);
$allergeneRepository = new AllergeneRepositoryMysql($pdo);
$imageMenuRepository = new ImageMenuRepositoryMysql($pdo);
$utilisateurRepository = new UtilisateurRepositoryMysql($pdo);

// --- Étape 2 : tester une vraie méthode ---
$commande = $commandesRepository->getById(1);
$utilisateur = $utilisateurRepository->getById(1);
$menu = $menuRepository->getById(1);
$theme = $themeRepository->getById(1);
$regime = $regimeRepository->getById(1);
$allergene = $allergeneRepository->getById(1);
$imageMenu = $imageMenuRepository->getById(1);

echo '<pre>';
print_r($commande);
print_r($utilisateur);
print_r($menu);
print_r($theme);
print_r($regime);
print_r($allergene);
print_r($imageMenu);    
echo '</pre>';

