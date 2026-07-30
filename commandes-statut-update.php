<?php
session_start();
require 'includes/db.php';
header('Content-Type: application/json');

if (isset($_SESSION['utilisateur'])) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $commandeId = $_POST['commande_id'] ?? null;
        $nouveauStatut = $_POST['statut'] ?? null;

        $statusAutorises = ['en attente', 'validé', 'annulé'];

        if ($commandeId && in_array($nouveauStatut, $statusAutorises, true)) {

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