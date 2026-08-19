<?php

use Controllers\AvisController;
use Controllers\UtilisateurController;
use includes\Autoloader;
use Repositories\AvisRepositoryMongoDB;
use Repositories\CommandesRepositoryMysql;
use Repositories\HistoriqueStatutRepositoryMysql;
use Repositories\UtilisateurRepositoryMysql;


require __DIR__ . '/includes/Autoloader.php';
require __DIR__ . '/Bootstraps/bootstrap-db.php';
Autoloader::register();
header('Content-Type: application/json');


$historiqueRepository = new HistoriqueStatutRepositoryMysql($pdo);
$commandesRepository = new CommandesRepositoryMysql($pdo, $historiqueRepository);
$avisRepository = new AvisRepositoryMongoDB($manager);
$avisController = new AvisController($avisRepository, $commandesRepository);
$utilisateurRepository = new UtilisateurRepositoryMysql($pdo);
$utilisateurController = new UtilisateurController($utilisateurRepository);


$toutLesAvis = $avisController->getAllAvis();


$avis = [];
foreach ($toutLesAvis as $unAvis) {
    $utilisateurId = $unAvis->getUtilisateurId();
    $utilisateurInfos = $utilisateurController->trouverUtilisateur($unAvis->getUtilisateurId());
    $avis[] = [
        'utilisateur_id' => $unAvis->getUtilisateurId(),
        'commande_id' => $unAvis->getCommandeId(),
        'note' => $unAvis->getNote(),
        'commentaire' => $unAvis->getCommentaire(),
        'date_avis' => $unAvis->getDateAvis(),
        'nom' => $utilisateurInfos->getNom() ?? 'Doe',
        'prenom' => $utilisateurInfos->getPrenom() ?? 'John',
    ];
}
echo json_encode(['success' => true, 'avis' => $avis]);
