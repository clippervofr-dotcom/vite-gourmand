<?php
session_start();
require 'includes/db.php';
require 'includes/mongo-db.php';
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

$stmt = $pdo->prepare('SELECT utilisateur_id, possede_avis FROM commande WHERE commande_id = ?');
$stmt->execute([$commandeId]);
$commande = $stmt->fetch();

if (!$commande || $commande['utilisateur_id'] != $_SESSION['utilisateur']['utilisateur_id']) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur invalide.']);
    exit;
}

if ($commande['possede_avis'] == 1) {
    echo json_encode(['success' => false, 'message' => 'La commande possède déjà un avis.']);
    exit;
}

$bulk = new MongoDB\Driver\BulkWrite();
$bulk->insert([
    'utilisateur_id' => $_SESSION['utilisateur']['utilisateur_id'],
    'commande_id' => $commandeId,
    'note' => $note,
    'commentaire' => $commentaire,
    'date_avis' => date('Y-m-d H:i:s'),
]);
$manager->executeBulkWrite('vite_et_gourmand.avis', $bulk);

$stmt = $pdo->prepare('UPDATE commande SET possede_avis = ? WHERE commande_id = ?');
$stmt->execute([1, $commandeId]);

echo json_encode(['success' => true]);