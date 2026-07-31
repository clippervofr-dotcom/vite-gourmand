<?php
session_start();
require 'includes/db.php';
header('Content-Type: application/json');

if (isset($_SESSION['utilisateur'])) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        $nom = trim($_POST['nom'] ?? '');
        $prenom = trim($_POST['prenom'] ?? '');
        $adresse = trim($_POST['adresse'] ?? '');
        $codePostal = trim($_POST['code_postal'] ?? '');
        $ville = trim($_POST['ville'] ?? '');
        $telephone = trim($_POST['telephone'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if ($nom !== '' && $prenom !== '' && $adresse !== '' && $codePostal !== '' && $ville !== '' && $telephone !== '' && $email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $stmt = $pdo->prepare('
                            UPDATE utilisateur SET 
                           nom = ?, 
                           prenom = ?, 
                           adresse = ?, 
                           code_postal = ?, 
                           ville = ?, 
                           telephone = ?, 
                           email = ? 
                            WHERE utilisateur_id = ?');

            $stmt->execute([
                $nom,
                $prenom,
                $adresse,
                $codePostal,
                $ville,
                $telephone,
                $email,
                $_SESSION['utilisateur']['utilisateur_id']
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Formulaire invalide']);
        }
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Non autorisé.']);
    }
}

