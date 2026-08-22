<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../src/Config/bootstrap.php';
require_once ROOT_PATH . '/src/Config/session.php';

use Controllers\UtilisateurController;
use Repositories\UtilisateurRepositoryMysql;
use Services\TarificationService;

header('Content-Type: application/json');

if (!isset($_SESSION['utilisateur'])) {
    echo json_encode(['success' => false, 'message' => 'Non connecté.']);
    exit;
}

$utilisateurSessionId = $_SESSION['utilisateur']['utilisateur_id'] ?? null;
$panierComplet = $_SESSION['panier'] ?? [];

$itemId = $_GET['item'] ?? null;
if (!$itemId) {
    echo json_encode(['success' => false, 'message' => 'ID de l\'item manquant.']);
    exit;
}

$menuChoisi = null;
foreach ($panierComplet as $item) {
    if ($item['uniqueId'] === $itemId) {
        $menuChoisi = $item;
        break;
    }
}
if (!$menuChoisi) {
    echo json_encode(['success' => false, 'message' => 'Item non trouvé.']);
    exit;
}

$utilisateurRepository = new UtilisateurRepositoryMysql($pdo);
$utilisateurController = new UtilisateurController($utilisateurRepository);

$utilisateur = $utilisateurController->trouverUtilisateur((int)$utilisateurSessionId);
if (!$utilisateur) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur introuvable.']);
    exit;
}

$adresse = $utilisateur->getAdresse() . " " . $utilisateur->getCodePostal() . " " . $utilisateur->getVille();
$distanceKm = TarificationService::calculerDistanceKm($adresse);
if ($distanceKm === null) {
    echo json_encode(['success' => false, 'message' => 'Adresse invalide, impossible de calculer la distance. Veuillez vérifier votre adresse.']);
    exit;
}

$distanceKm = round($distanceKm, 0);

//array
$tarifications = TarificationService::calculerPrixLivraison($distanceKm, (float)$menuChoisi['prix_total']);


echo json_encode([
    'success' => true,
    'panier' => $menuChoisi,
    'info' => [
        'nom' => $utilisateur->getNom(),
        'prenom' => $utilisateur->getPrenom(),
        'adresse' => $utilisateur->getAdresse(),
        'code_postal' => $utilisateur->getCodePostal(),
        'ville' => $utilisateur->getVille(),
        'telephone' => $utilisateur->getTelephone(),
        'email' => $utilisateur->getEmail(),
        'date' => date('Y-m-d H:i:s'),
        'distance' => $distanceKm,
        'prix_materiel' => $tarifications['prixMateriel'],
        'prix_livraison' => $tarifications['prixTotalDistance'],
        'total_avec_materiel' => $tarifications['totalAvecMateriel'],
        'total_sans_materiel' => $tarifications['totalSansMateriel'],
    ]
]);









