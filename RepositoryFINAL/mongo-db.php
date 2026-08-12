<?php

try {
    $manager = new MongoDB\Driver\Manager('mongodb+srv://clippervo_db_user:ZUFzjP0MkKQ1Z8Ai@cluster0.rbba3yn.mongodb.net/?appName=Cluster0');
} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Erreur de connexion MongoDB : ' . $e->getMessage()]);
    exit;
}