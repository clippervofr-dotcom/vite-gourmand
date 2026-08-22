<?php

use Controllers\AvisController;
use Controllers\CommandesController;
use Controllers\HorairesController;
use Controllers\MenuController;
use Controllers\PlatController;
use Controllers\UtilisateurController;
use Repositories\AllergeneRepositoryMysql;
use Repositories\AvisRepositoryMongoDB;
use Repositories\CommandesRepositoryMysql;
use Repositories\HistoriqueStatutRepositoryMysql;
use Repositories\horairesRepositoryMysql;
use Repositories\ImageMenuRepositoryMysql;
use Repositories\MenuRepositoryMysql;
use Repositories\PlatRepositoryMysql;
use Repositories\RegimeRepositoryMysql;
use Repositories\RoleRepositoryMysql;
use Repositories\ThemeRepositoryMysql;
use Repositories\UtilisateurRepositoryMysql;
use Services\TarificationService;


require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Config/bootstrap.php';
require_once ROOT_PATH . '/src/Config/mongodb.php';

header('Content-Type: application/json');

// Instanciation des repositories et des controllers
//Repositories
$historiqueRepository = new HistoriqueStatutRepositoryMysql($pdo);
$commandesRepository = new CommandesRepositoryMysql($pdo, $historiqueRepository);
$menuRepository = new MenuRepositoryMysql($pdo);
$themeRepository = new ThemeRepositoryMysql($pdo);
$regimeRepository = new RegimeRepositoryMysql($pdo);
$allergeneRepository = new AllergeneRepositoryMysql($pdo);
$imageMenuRepository = new ImageMenuRepositoryMysql($pdo);
$utilisateurRepository = new UtilisateurRepositoryMysql($pdo);
$avisRepository = new AvisRepositoryMongoDB($manager);
$horairesRepository = new HorairesRepositoryMysql($pdo);
$historiqueStatutRepository = new HistoriqueStatutRepositoryMysql($pdo);
$roleRepository = new RoleRepositoryMysql($pdo);
$platRepository = new PlatRepositoryMysql($pdo);

//Controllers
$avisController = new AvisController($avisRepository, $commandesRepository);
$horairesController = new HorairesController($horairesRepository);
$commandesController = new CommandesController($commandesRepository);
$utilisateurController = new UtilisateurController($utilisateurRepository);
$platController = new PlatController($platRepository);
$menuController = new MenuController($menuRepository);

//Services
$tarificationService = new TarificationService();



//Tests
//Variables pour les tests
$roleId = 2;
$statutDemande = 'en attente';
$email = 'jojo@gmail.com';



// Récupération des données pour les tests
$commande = $commandesRepository->getById(1);
$utilisateur = $utilisateurRepository->getById(1);
$menu = $menuRepository->getById(1);
$theme = $themeRepository->getById(1);
$regime = $regimeRepository->getById(1);
$allergene = $allergeneRepository->getById(1);
$imageMenu = $imageMenuRepository->getByImageId(1);
$toutLesHorairesTrier = $horairesController->getByOrderedId();
$resultatsAvis = $avisController->getAllAvis();
$commandes2 = $commandesController->findByStatut($statutDemande);
$listeByRole = $roleRepository->getAll();



// Affichage des résultats pour les tests


$commandesAndTitreMenu = [];
foreach ($commandes2 as $commande) {
    $menu = $menuRepository->getById($commande->getMenuId());
    $commandesAndTitreMenu[] = [
        'commande_id' => $commande->getCommandeId(),
        'menu_id' => $commande->getMenuId(),
        'titre_menu' => $menu ? $menu->getTitre() : null,
        'statut' => $commande->getStatut(),
        'date_commande' => $commande->getDateCommande(),
        'motif_annulation' => $commande->getMotifAnnulation(),
        'mode_contact_annulation' => $commande->getModeContactAnnulation(),
    ];
}


$utilisateurEmail = $utilisateurController->findUtilisateurByEmail($email);


//print_r des résultats pour les tests

echo '<pre>';
print_r($utilisateur);
print_r($menu);
print_r($theme);
print_r($regime);
print_r($allergene);
print_r($imageMenu);
print_r($resultatsAvis);
print_r($toutLesHorairesTrier);
print_r($commandes2);
print_r($commandesAndTitreMenu);
print_r($utilisateurEmail);
print_r($listeByRole);
echo json_encode($commandesAndTitreMenu);
echo '</pre>';



