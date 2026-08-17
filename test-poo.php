<?php
use Repositories\HistoriqueStatutRepositoryMysql;
use Repositories\CommandesRepositoryMysql;
use Repositories\MenuRepositoryMysql;
use Repositories\RoleRepositoryMysql;
use Repositories\ThemeRepositoryMysql;
use Repositories\RegimeRepositoryMysql;
use Repositories\AllergeneRepositoryMysql;
use Repositories\ImageMenuRepositoryMysql;
use Repositories\UtilisateurRepositoryMysql;
use Repositories\AvisRepositoryMongoDB;
use Controllers\AvisController;
use Controllers\HorairesController;
use Repositories\horairesRepositoryMysql;
use Controllers\UtilisateurController;
use Controllers\CommandesController;


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
$horairesRepository = new HorairesRepositoryMysql($pdo);
$horairesController = new HorairesController($horairesRepository);
$historiqueStatutRepository = new HistoriqueStatutRepositoryMysql($pdo);
$commandesController = new CommandesController($commandesRepository);
$utilisateurController = new UtilisateurController($utilisateurRepository);
$roleRepository = new RoleRepositoryMysql($pdo);

$roleId = 2;
$statutDemande = 'en attente';
// --- Étape 2 : tester une vraie méthode ---
//$commande = $commandesRepository->getById(1);
$utilisateur = $utilisateurRepository->getById(1);
$menu = $menuRepository->getById(1);
$theme = $themeRepository->getById(1);
$regime = $regimeRepository->getById(1);
$allergene = $allergeneRepository->getById(1);
$imageMenu = $imageMenuRepository->getById(1);
$toutLesHorairesTrier = $horairesController->getByOrderedId();
$resultatsAvis = $avisController->getAllAvis();
$commandes = $commandesController->findByStatut($statutDemande);
$listeByRole = $roleRepository->getAllByRole($roleId);

$commandesAndTitreMenu = [];
foreach ($commandes as $commande) {
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

$email = 'jojo@gmail.com';
$utilisateurEmail = $utilisateurController->findUtilisateurByEmail($email);

echo '<pre>';
// print_r($commande);
print_r($utilisateur);
print_r($menu);
print_r($theme);
print_r($regime);
print_r($allergene);
print_r($imageMenu);
print_r($resultatsAvis);
print_r($toutLesHorairesTrier);
print_r($commandes);
print_r($commandesAndTitreMenu);
print_r($utilisateurEmail);
print_r($listeByRole);
echo json_encode($commandesAndTitreMenu);
echo '</pre>';



