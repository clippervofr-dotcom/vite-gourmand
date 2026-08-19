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

verifierCsrf();

$commandeId = $_POST['commande_id'] ?? null;
$nouveauStatut = $_POST['statut'] ?? null;

$statusAutorises = 'annulée';

$historiqueStatutRepository = new HistoriqueStatutRepositoryMysql($pdo);
$commandesRepository = new CommandesRepositoryMysql($pdo, $historiqueStatutRepository);
$commandesController = new CommandesController($commandesRepository);

$commande = $commandesController->getCommandeById((int)$commandeId);

if (!$commande) {
    echo json_encode(['success' => false, 'message' => 'Commande inconnue.']);
    exit;
}

$utilisateurId = $commande->getUtilisateurId();

if (!$utilisateurId || $utilisateurId != $_SESSION['utilisateur']['utilisateur_id']) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur invalide.']);
    exit;
}

if ($commandeId && $nouveauStatut === $statusAutorises) {
    $commande->setStatut($nouveauStatut);
    $annulationCommande = $commandesController->saveOrUpdateCommande($commande);

    if ($annulationCommande['success']) {
        echo json_encode(['success' => true, 'message' => 'Commande annulée avec succès.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'annulation de la commande.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Paramètres d\'annulation invalides.']);
}