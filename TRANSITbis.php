<?php
require 'includes/db.php';
header('Content-Type: application/json');

$commandeId = 1;

$stmt = $pdo->prepare('SELECT utilisateur_id, possede_avis FROM commande WHERE commande_id = ?');
$stmt->execute([$commandeId]);
$utilisateur = $stmt->fetch();

echo json_encode(typeOf: $utilisateur);
