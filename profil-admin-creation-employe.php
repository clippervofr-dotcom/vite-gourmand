<?php
require 'includes/db.php';
session_start();
header('Content-Type: application/json');


if (isset($_SESSION['utilisateur'])) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_SESSION['utilisateur']['role_id'] === 3)) {

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $ville = $_POST['ville'];
        $codePostal = $_POST['code_postal'];
        $adresse  = $_POST['adresse'];
        $role = 0;

        if ($_POST['role'] === 'admin') {
            $role = 3;
        } else if ($_POST['role'] === 'employe') {
            $role = 2;
        } else {
            echo json_encode(['success' => false, 'message' => 'Rôle invalide.']);
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Email invalide']);
            exit;
        }


        $stmt = $pdo->prepare("INSERT INTO utilisateur (nom, prenom, email, telephone, role_id, ville, code_postal, adresse) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $email, $telephone, $role, $ville, $codePostal, $adresse]);


        echo json_encode(['success' => true, 'message' => 'Employé créé avec succès.']);

    } else {
        echo json_encode(['success' => false, 'message' => 'Droits insuffisant.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Non connecté.']);
}
