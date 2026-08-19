<?php
session_start();

use Controllers\CommandesController;
use includes\Autoloader;
use Repositories\CommandesRepositoryMysql;
use Repositories\HistoriqueStatutRepositoryMysql;

require __DIR__ . '/includes/Autoloader.php';
require __DIR__ . '/Bootstraps/bootstrap-db.php';
require __DIR__ . '/includes/csrf.php';
Autoloader::register();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Mauvaise méthode.']);
    exit;
}

if (!isset($_SESSION['utilisateur'])) {
    echo json_encode(['success' => false, 'message' => 'Non connecté.']);
    exit;
}

if (!($_SESSION['utilisateur']['role_id'] === 2 || $_SESSION['utilisateur']['role_id'] === 3)) {
    echo json_encode(['success' => false, 'message' => 'Droits insuffisants.']);
    exit;
}

verifierCsrf();

$commandeId = $_POST['commande_id'] ?? null;
$nouveauStatut = $_POST['statut'] ?? null;
$statusAutorises = 'validée';

$historiqueStatutRepository = new HistoriqueStatutRepositoryMysql($pdo);
$commandesRepository = new CommandesRepositoryMysql($pdo, $historiqueStatutRepository);
$commandesController = new CommandesController($commandesRepository);

if ($commandeId && $nouveauStatut === $statusAutorises) {
    $commande = $commandesController->getCommandeById((int)$commandeId);
    if (!$commande) {
        echo json_encode(['success' => false, 'message' => 'Commande introuvable.']);
        exit;
    }

    $commande->setStatut($nouveauStatut);
    $validationCommande = $commandesController->saveOrUpdateCommande($commande);

    if ($validationCommande['success']) {
        echo json_encode(['success' => true, 'message' => 'Commande validée avec succès.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la validation de la commande.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Paramètres invalides.']);
}