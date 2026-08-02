<?php
session_start();
require 'includes/db.php';
header('Content-Type: application/json');

if (isset($_SESSION['utilisateur'])) {
    if ($_SESSION['utilisateur']['role_id'] === 3) {

        $stmt = $pdo->prepare('UPDATE horaire SET ');
        $stmt->execute();

        $horaires = $stmt->fetchAll();

        echo json_encode($horaires);
    } else {
        echo json_encode(['success' => false, 'message' => 'Droits insuffisants.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Non connecté.']);
}