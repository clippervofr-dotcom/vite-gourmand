<?php
require 'includes/db.php';
session_start();
header('Content-Type: application/json');


if (isset($_SESSION['utilisateur'])) {
    if ($_SESSION['utilisateur']['role_id'] === 3) {

        $roleId = 2;

        $stmt = $pdo->prepare('SELECT utilisateur.nom, utilisateur.prenom, utilisateur.telephone, utilisateur.email, role.libelle FROM utilisateur JOIN role ON role.role_id = utilisateur.role_id WHERE utilisateur.role_id = ?;');
        $stmt->execute([$roleId]);
        $listeEmploye = $stmt->fetchAll();

        echo json_encode($listeEmploye);

    } else {
        echo json_encode(['success' => false, 'message' => 'Droits insuffisant.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Non connecté.']);
}
