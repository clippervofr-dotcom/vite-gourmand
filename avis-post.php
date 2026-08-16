<?php
session_start();

use Controllers\AvisController;
use Repositories\HistoriqueStatutRepositoryMysql;
use Repositories\CommandesRepositoryMysql;
use Repositories\AvisRepositoryMongoDB;
use Entities\Avis;

use includes\Autoloader;
require __DIR__ . '/includes/Autoloader.php';
require __DIR__ . '/Bootstraps/bootstrap-db.php';
Autoloader::register();
header('Content-Type: application/json');

if (!isset($_SESSION['utilisateur'])) {
    echo json_encode(['success' => false, 'message' => 'Non connecté.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Mauvaise méthode.']);
    exit;
}

$commandeId = $_POST['commande_id'] ?? null;
$note = $_POST['etoile_nombre'] ?? null;
$commentaire = $_POST['commentaire'] ?? '';

if (!$commandeId || !$note) {
    echo json_encode(['success' => false, 'message' => 'Données manquantes.']);
    exit;
}

$historiqueRepository = new HistoriqueStatutRepositoryMysql($pdo);
$commandesRepository = new CommandesRepositoryMysql($pdo, $historiqueRepository);
$avisRepository = new AvisRepositoryMongoDB($manager);
$avisController = new AvisController($avisRepository, $commandesRepository);

$avis = new Avis(
    utilisateurId: $_SESSION['utilisateur']['utilisateur_id'],
    commandeId: (int) $commandeId,
    note: (int) $note,
    commentaire: $commentaire,
    dateAvis: date('Y-m-d H:i:s')
);

$resultat = $avisController->ajouterAvis($avis);
echo json_encode($resultat);