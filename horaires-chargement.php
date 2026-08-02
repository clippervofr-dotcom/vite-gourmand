<?php
require 'includes/db.php';
header('Content-Type: application/json');

$stmt = $pdo->prepare('SELECT horaire.* FROM horaire ORDER BY horaire_id');
$stmt->execute();

$horaires = $stmt->fetchAll();

echo json_encode($horaires);

if (!$horaires) {
    echo json_encode(['success' => false, 'message' => 'Horaires manquants.']);
}
