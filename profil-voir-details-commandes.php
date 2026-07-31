<?php
require 'includes/db.php';
session_start();
header('Content-Type: application/json');


if (isset($_SESSION['utilisateur'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_SESSION['utilisateur']['role_id'] === 2) || ($_SESSION['utilisateur']['role_id'] === 3))) {

        $commandeId = $_POST['commande_id'] ?? null;

        $stmt = $pdo->prepare('
SELECT 
    commande.*, 
    utilisateur.nom AS utilisateur_nom,utilisateur.prenom AS utilisateur_prenom,utilisateur.email AS utilisateur_email,utilisateur.telephone AS utilisateur_telephone, 
    menu.titre
FROM commande 
JOIN utilisateur ON utilisateur.utilisateur_id = commande.utilisateur_id 
JOIN menu ON menu.menu_id = commande.menu_id 
WHERE commande_id = ?');

        $stmt->execute([$commandeId]);
        $commandeDetails = $stmt->fetch();

        if ($commandeDetails) {
            echo json_encode(['success' => true, 'commande' => $commandeDetails]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Commande non trouvée.']);
        }

//        echo json_encode([
//            'success' => true,
//            'info' => $commandeDetails
//        ]);

    } else {
        echo json_encode(['success' => false, 'message' => 'Accès refusé.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Veuillez vous connecter.']);
}