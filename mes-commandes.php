<?php
session_start();
require 'includes/db.php';

header('Content-Type: application/json');


if (!isset($_SESSION['utilisateur'])) {
    echo json_encode([]);
}


$stmt = $pdo->prepare('SELECT commande.*, menu.titre
                             FROM commande
                             JOIN menu ON commande.menu_id = menu.menu_id
                             WHERE commande.utilisateur_id = ?');

$stmt->execute([$_SESSION['utilisateur']['utilisateur_id']]);

$commandesUser = $stmt->fetchAll();

echo json_encode($commandesUser);

