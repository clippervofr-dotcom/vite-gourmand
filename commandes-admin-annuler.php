<?php
session_start();
require 'includes/db.php';
header('Content-Type: application/json');

if (isset($_SESSION['utilisateur'])) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_SESSION['utilisateur']['role_id'] === 3)) {

        $commandeId = $_POST['commande_id'] ?? null;
        $nouveauStatut = $_POST['statut'] ?? null;
        $annulationType = $_POST['annulation_type'] ?? null;
        $motif = substr($_POST['annulation_raison'] ?? '', 0, 500);

        $statusAutorises = 'annulée';
        $typeContactAutorises = ['sms', 'email', 'telephone'];


        if ($commandeId && $annulationType && in_array($annulationType, $typeContactAutorises) && $nouveauStatut === $statusAutorises) {

            $stmt = $pdo->prepare('UPDATE commande SET statut = ?, mode_contact_annulation = ?, motif_annulation = ? WHERE commande_id = ?');
            $stmt->execute([$nouveauStatut, $annulationType, $motif, $commandeId]);

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Paramètres invalides.']);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Non connecté.']);
}

