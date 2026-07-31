<?php
session_start();
require 'includes/db.php';
header('Content-Type: application/json');

if (isset($_SESSION['utilisateur'])) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $commandeId = $_POST['commande_id'] ?? null;
        $nouveauStatut = $_POST['statut'] ?? null;

        $statusAutorises = 'annulée';

        $stmt = $pdo->prepare('SELECT utilisateur_id FROM commande WHERE commande_id = ?');
        $stmt->execute([$commandeId]);
        $utilisateur = $stmt->fetch();

        if (!$utilisateur || $utilisateur['utilisateur_id'] != $_SESSION['utilisateur']['utilisateur_id']) {
            echo json_encode(['success' => false, 'message' => 'Utilisateur invalide.']);
            exit;
        }

        if ($commandeId && $nouveauStatut === $statusAutorises) {

            $stmt = $pdo->prepare('UPDATE commande SET statut = ? WHERE commande_id = ?');
            $stmt->execute([$nouveauStatut, $commandeId]);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Paramètres invalides.']);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Non connecté.']);
}
