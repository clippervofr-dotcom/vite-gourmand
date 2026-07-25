<?php
require 'includes/db.php';

header('Content-Type: application/json');

$stmt = $pdo->prepare('SELECT commande.*, menu.titre
                             FROM commande
                             JOIN menu ON commande.menu_id = menu.menu_id
                             WHERE commande.status = ?');
$stmt->execute(['en attente']);

$commandes = $stmt->fetchAll();

echo json_encode($commandes);

