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

function calculerDistanceKm(string $adresse): ?float
{
    $url = 'https://nominatim.openstreetmap.org/search?' . http_build_query(['q' => $adresse, 'format' => 'json', 'limit' => 1]);
    $ctx = stream_context_create(['http' => ['header' => "User-Agent: vite-et-gourmand/1.0\r\n"]]);
    $reponse = @file_get_contents($url, false, $ctx);
    if ($reponse === false) return null;
    $resultats = json_decode($reponse, true);
    if (empty($resultats[0]['lat']) || empty($resultats[0]['lon'])) return null;

    return distanceHaversine((float)$resultats[0]['lat'], (float)$resultats[0]['lon'], 44.8545292, -0.5694775);
}

function distanceHaversine(float $lat1, float $lon1, float $lat2, float $lon2): float
{
    $rayonTerre = 6371;
    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);
    $a = sin($dLat / 2) ** 2 + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) ** 2;
    return $rayonTerre * 2 * atan2(sqrt($a), sqrt(1 - $a));
}

$adresse = $utilisateur->getAdresse() . " " . $utilisateur->getCodePostal() . " " . $utilisateur->getVille();
$distanceKm = calculerDistanceKm($adresse);
if ($distanceKm === null) {
    echo json_encode(['success' => false, 'message' => 'Erreur lors du calcul de la distance.']);
    exit;
}

$distanceKm = round($distanceKm, 0);

$prixMateriel = 99;
$prixSurplusKm = 1.5;
$prixTotalDistance = 0;

if ($distanceKm > 5) {
    $distanceSupplementaire = (int)$distanceKm - 5;
    $prixTotalDistance = $distanceSupplementaire * $prixSurplusKm;
}

$prixTotal = $menuChoisi['prix_total'];

$totalAvecMateriel = $prixTotal + $prixMateriel + $prixTotalDistance;
$totalSansMateriel = $prixTotal + $prixTotalDistance;

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
        'prix_materiel' => $prixMateriel,
        'prix_livraison' => $prixTotalDistance,
        'total_avec_materiel' => $totalAvecMateriel,
        'total_sans_materiel' => $totalSansMateriel,
    ]
]);









