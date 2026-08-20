<?php

use Controllers\AvisController;
use Controllers\UtilisateurController;
use Repositories\AvisRepositoryMongoDB;
use Repositories\CommandesRepositoryMysql;
use Repositories\HistoriqueStatutRepositoryMysql;
use Repositories\UtilisateurRepositoryMysql;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../src/Config/bootstrap.php';
require_once ROOT_PATH . '/src/Config/mongodb.php';
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
        'nom' =>  $utilisateurInfos !== null ? $utilisateurInfos->getNom() : 'Doe',
        'prenom' => $utilisateurInfos !== null ? $utilisateurInfos->getPrenom() : 'John',
    ];
}
echo json_encode(['success' => true, 'avis' => $avis]);
