<?php
session_start();
require 'includes/db.php';
header('Content-Type: application/json');

if (isset($_SESSION['utilisateur'])) {
    if ($_SESSION['utilisateur']['role_id'] === 3) {

        $jours = [
            1 => 'lundi', 2 => 'mardi', 3 => 'mercredi',
            4 => 'jeudi', 5 => 'vendredi', 6 => 'samedi'
        ];

        $pdo->beginTransaction();

        try {
            $stmt = $pdo->prepare('UPDATE horaire SET heure_ouverture = ?, heure_fermeture = ? WHERE horaire_id = ?');

            foreach ($jours as $horaireId => $nomJour) {
                $ouverture = $_POST[$nomJour . '-ouverture'] ?? '';
                $fermeture = $_POST[$nomJour . '-fermeture'] ?? '';

                $stmt->execute([$ouverture, $fermeture, $horaireId]);
            }

            $pdo->commit();
            echo json_encode(['success' => true]);

        } catch (Exception $exception) {
            $pdo->rollBack();
            echo json_encode(['success' => false, 'message' => 'Erreur : ' . $exception->getMessage()]);
        }

    } else {
        echo json_encode(['success' => false, 'message' => 'Droits insuffisants.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Non connecté.']);
}