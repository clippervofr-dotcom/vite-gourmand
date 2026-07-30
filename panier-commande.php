<?php
require 'includes/db.php';

header('Content-Type: application/json');

session_start();

if (!isset($_SESSION['utilisateur'])) {
    echo json_encode(['success' => false, 'message' => 'Non connecté.']);
    exit;
}

$stmtUtilisateur = $pdo->prepare("SELECT nom, prenom, adresse, code_postal, ville, telephone, email FROM utilisateur WHERE utilisateur_id = ?");
$stmtUtilisateur->execute([$_SESSION['utilisateur']['utilisateur_id']]);
$info = $stmtUtilisateur->fetch();
if (!$info) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur introuvable.']);
    exit;
}

// commande script python pour calcul lat/long et distance km
$adresse = ($info['adresse'] . " " . $info['code_postal'] . " " . $info['ville']);
$python = "C:\\xampp\\htdocs\\vite-et-gourmand\\venv\\Scripts\\python.exe";
$commande = escapeshellarg($python) . " " . escapeshellarg("C:\\xampp\\htdocs\\vite-et-gourmand\\assets\\py\\localisationbis.py") . " " . escapeshellarg($adresse);
$sortie = shell_exec($commande);           // récupère tout ce que print() a affiché
$coordonnees = json_decode($sortie, true); // transforme le JSON en tableau PHP
if ($coordonnees['success']) {
    $distanceKm = round($coordonnees['distance'], 0);
}

$info['date'] = date('Y-m-d H:i:s');
$info['distance'] = $distanceKm;

$itemId = $_GET['item'] ?? null;

$panierComplet = $_SESSION['panier'] ?? [];
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

echo json_encode([
    'success' => true,
    'panier' => $menuChoisi,
    'info' => $info
]);

