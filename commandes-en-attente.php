<?php
require 'includes/db.php';

header('Content-Type: application/json');

$statusAutorises = ['en attente', 'validé', 'annulé'];
$statutDemande = $_GET['statut'] ?? 'en attente';

if (!in_array($statutDemande, $statusAutorises)) {
    $statutDemande = 'en attente';
}

$stmt = $pdo->prepare('SELECT commande.*, menu.titre
                             FROM commande
                             JOIN menu ON commande.menu_id = menu.menu_id
                             WHERE commande.statut = ?');
$stmt->execute([$statutDemande]);

$commandes = $stmt->fetchAll();

echo json_encode($commandes);


