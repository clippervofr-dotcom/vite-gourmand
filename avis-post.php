<?php
session_start();
require 'includes/db.php';
require 'includes/mongo-db.php';
header('Content-Type: application/json');

if (isset($_SESSION['utilisateur'])) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $commandeId = $_POST['commande_id'] ?? null;
        $note = $_POST['etoile_nombre'] ?? null;
        $commentaire = $_POST['commentaire'] ?? '';

        if (!$commandeId || !$note) {
            echo json_encode(['success' => false, 'message' => 'Données manquantes.']);
            exit;
        }

        $stmt = $pdo->prepare('SELECT utilisateur_id FROM commande WHERE commande_id = ?');
        $stmt->execute([$commandeId]);
        $utilisateur = $stmt->fetch();

        if (!$utilisateur || $utilisateur['utilisateur_id'] != $_SESSION['utilisateur']['utilisateur_id']) {
            echo json_encode(['success' => false, 'message' => 'Utilisateur invalide.']);
            exit;
        }

        $bulk = new MongoDB\Driver\BulkWrite();

        $bulk->insert([
            'utilisateur_id' => $_SESSION['utilisateur']['utilisateur_id'],
            'commande_id' => $commandeId,
            'note' => $note,
            'commentaire' => $commentaire,
        ]);
        $manager->executeBulkWrite('vite_et_gourmand.avis', $bulk);
        echo json_encode(['success' => true]);

    } else {
        echo json_encode(['success' => false, 'message' => 'Mauvaise méthode.']);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Non connecté.']);
    exit;
}


