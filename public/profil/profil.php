<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../src/Config/bootstrap.php';
require_once ROOT_PATH . '/src/Config/session.php';

use Controllers\UtilisateurController;
use Repositories\UtilisateurRepositoryMysql;

header('Content-Type: application/json');

if (!isset($_SESSION['utilisateur'])) {
    echo json_encode(['success' => false, 'message' => 'Non connecté.']);
    exit;
}

$utilisateurId = $_SESSION['utilisateur']['utilisateur_id'];

$utilisateurRepository = new UtilisateurRepositoryMysql($pdo);
$utilisateurController = new UtilisateurController($utilisateurRepository);

$utilisateur = $utilisateurController->trouverUtilisateur((int)$utilisateurId);
if (!$utilisateur) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur introuvable.']);
    exit;
} else {
    $infoUtilisateur = [
        'success' => true,
        'nom' => $utilisateur->getNom(),
        'prenom' => $utilisateur->getPrenom(),
        'adresse' => $utilisateur->getAdresse(),
        'code_postal' => $utilisateur->getCodePostal(),
        'ville' => $utilisateur->getVille(),
        'telephone' => $utilisateur->getTelephone(),
        'email' => $utilisateur->getEmail(),
    ];
}
echo json_encode($infoUtilisateur);