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

if (!($_SESSION['utilisateur']['role_id'] === 3)) {
    echo json_encode(['success' => false, 'message' => 'Droits insuffisants.']);
    exit;
}

verifierCsrf();

$commandeId = $_POST['commande_id'] ?? null;
$nouveauStatut = $_POST['statut'] ?? null;
$annulationType = $_POST['annulation_type'] ?? null;
$motif = mb_substr($_POST['annulation_raison'] ?? '', 0, 500);

$statusAutorises = 'annulée';
$typeContactAutorises = ['sms', 'email', 'telephone'];

$historiqueStatutRepository = new HistoriqueStatutRepositoryMysql($pdo);
$commandesRepository = new CommandesRepositoryMysql($pdo, $historiqueStatutRepository);
$commandesController = new CommandesController($commandesRepository);


if ($commandeId !== null && $annulationType !== null && in_array($annulationType, $typeContactAutorises) && $nouveauStatut === $statusAutorises) {
    $commande = $commandesController->getCommandeById((int)$commandeId);
    if (!$commande) {
        echo json_encode(['success' => false, 'message' => 'Commande introuvable.']);
        exit;
    }

    $commande->setMotifAnnulation($motif);
    $commande->setModeContactAnnulation($annulationType);
    $commande->setStatut($nouveauStatut);
    $annulationCommande = $commandesController->saveOrUpdateCommande($commande);

    //verif annulation
    if ($annulationCommande['success']) {
        echo json_encode(['success' => true, 'message' => 'Commande annulée avec succès.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'annulation de la commande.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Paramètres d\'annulation invalides.']);
}
