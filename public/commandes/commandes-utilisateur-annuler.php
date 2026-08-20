<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../src/Config/bootstrap.php';
require_once ROOT_PATH . '/src/Config/session.php';
require ROOT_PATH . '/src/Security/csrf.php';

use Controllers\CommandesController;
use Repositories\CommandesRepositoryMysql;
use Repositories\HistoriqueStatutRepositoryMysql;

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
$motifAnnulation = mb_substr($_POST['motif_annulation'] ?? null, 0, 500);

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
    $commande->setMotifAnnulation($motifAnnulation);
    $annulationCommande = $commandesController->saveOrUpdateCommande($commande);

    if ($annulationCommande['success']) {
        echo json_encode(['success' => true, 'message' => 'Commande annulée avec succès.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'annulation de la commande.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Paramètres d\'annulation invalides.']);
}