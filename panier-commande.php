<?php
session_start();

use Controllers\UtilisateurController;
use includes\Autoloader;
use Repositories\UtilisateurRepositoryMysql;

require __DIR__ . '/includes/Autoloader.php';
require __DIR__ . '/Bootstraps/bootstrap-db.php';
Autoloader::register();
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

// recuperation et formatage adresse de l'utilisateur pour le script python
$adresse = $utilisateur->getAdresse() . " " . $utilisateur->getCodePostal() . " " . $utilisateur->getVille();
// chemin vers l'interpréteur Python
$python = "C:\\xampp\\htdocs\\vite-et-gourmand\\venv\\Scripts\\python.exe";
// commande pour exécuter le script Python avec : adresse de l'interpréteur + chemin du script + adresse de l'utilisateur
$commande = escapeshellarg($python) . " " . escapeshellarg("C:\\xampp\\htdocs\\vite-et-gourmand\\assets\\py\\localisationbis.py") . " " . escapeshellarg($adresse);
// récupère tout ce que print() a affiché
$sortie = shell_exec($commande);
// transforme le JSON en tableau PHP
$coordonnees = json_decode($sortie, true);

if ($coordonnees['success']) {
    $distanceKm = round($coordonnees['distance'], 0);
} else {
    echo json_encode(['success' => false, 'message' => 'Erreur lors du calcul de la distance.']);
    exit;
}

$prixTotal = $menuChoisi['prix_total'];
$prixMateriel = 99;
$prixSurplusKm = 1.5;
$prixTotalDistance = 0;

if ($distanceKm > 5) {
    $distanceSupplementaire = (int)$distanceKm - 5;
    $prixTotalDistance = $distanceSupplementaire * $prixSurplusKm;
}

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
        'total_sans_materiel' => $totalSansMateriel
    ]
]);









