<?php
if (file_exists(__DIR__ . '/.env')) {
    $env = parse_ini_file(__DIR__ . '/.env');
    if (array_key_exists('MYSQL_DSN', $env) && array_key_exists('MYSQL_USER', $env) && array_key_exists('MYSQL_PASS', $env)) {
        $pdoSql = $env['MYSQL_DSN'];
        $pdoUser = $env['MYSQL_USER'];
        $pdoPass = $env['MYSQL_PASS'];
    } else {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Les variables de connexion MYSQL sont introuvables dans le fichier .env.']);
        exit;
    }
    try {
        $pdo = new PDO($pdoSql, $pdoUser, $pdoPass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Erreur de connexion à la base de données : ' . $e->getMessage()]);
        exit;
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Le fichier .env est introuvable.']);
    exit;
}

// attribute = question / value = réponse
// ATTR_ERRMODE : mode de rapport d'erreur ? / ERRMODE_EXCEPTION : lance une PDOexception (erreur PDO par defaut)
// ATTR_DEFAULT_FETCH_MODE : methode de recuperation par defaut ? /  FETCH_ASSOC : tableau associatif


