<?php
require 'includes/db.php';
session_start();
header('Content-Type: application/json');

$statusAutorises = ['en attente', 'validée', 'annulée'];
$statutDemande = $_GET['statut'] ?? 'en attente';

if (!in_array($statutDemande, $statusAutorises)) {
    $statutDemande = 'en attente';
}

$stmt = $pdo->prepare('SELECT commande.*, menu.titre FROM commande JOIN menu ON commande.menu_id = menu.menu_id WHERE commande.statut = ?');
$stmt->execute([$statutDemande]);

$commandes = $stmt->fetchAll();

echo json_encode($commandes);





