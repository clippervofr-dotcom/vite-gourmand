<?php
require 'includes/db.php';
header('Content-Type: application/json');
session_start();

if (!isset($_SESSION['utilisateur'])) {
    echo json_encode(['success' => false, 'message' => 'Non connecté.']);
    exit;
}

//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$stmtUtilisateur = $pdo->prepare("SELECT nom, prenom, adresse, code_postal, ville, telephone, email FROM utilisateur WHERE utilisateur_id = ?");
$stmtUtilisateur->execute([$_SESSION['utilisateur']['utilisateur_id']]);
$info = $stmtUtilisateur->fetch();
if (!$info) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur introuvable.']);
    exit;
}
    echo json_encode($info);
//}


