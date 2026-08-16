<?php


// verif si fichier .env existe
if (file_exists(__DIR__ . '/.env')) {
    $env = parse_ini_file(__DIR__ . '/.env');
    //verif si la variable MONGO_DB existe dans le fichier .env
    if (array_key_exists('MONGO_DSN', $env)) {
        $mongo_db = $env['MONGO_DSN'];
    } else {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'La variable MONGO_DSN est introuvable dans le fichier .env.']);
        exit;
    }
    //on essaye de faire une instance de MongoDB\Driver\Manager avec la variable MONGO_DSN
    try {
        $manager = new MongoDB\Driver\Manager($mongo_db);
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Erreur de connexion à MongoDB : ' . $e->getMessage()]);
        exit;
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Le fichier .env est introuvable.']);
    exit;
}

