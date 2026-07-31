<?php
require 'includes/db.php';
session_start();
header('Content-Type: application/json');


if (isset($_SESSION['utilisateur'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_SESSION['utilisateur']['role_id'] === 2)) {

        $commandeId = $_POST['commande_id'] ?? null;
        $nouveauStatut = $_POST['statut'] ?? null;
        $statusAutorises = 'validée';

        if ($commandeId && $nouveauStatut === $statusAutorises) {

            $stmt = $pdo->prepare('UPDATE commande SET statut = ? WHERE commande_id = ?');
            $stmt->execute([$nouveauStatut, $commandeId]);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Paramètres invalides.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Accès refusé.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Non connecté.']);
}
