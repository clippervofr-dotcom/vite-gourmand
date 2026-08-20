<?php
// verif si fichier .env existe
if (file_exists(ROOT_PATH . '/.env')) {
    $env = parse_ini_file(ROOT_PATH . '/.env');
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
        error_log('Erreur connexion BDD : ' . $e->getMessage());
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Le service est momentanément indisponible, veuillez réessayer plus tard.']);
        exit;
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Le fichier .env est introuvable.']);
    exit;
}

