<?php

$host = 'localhost';
$dbname = 'vite_et_gourmand';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// attribute : question / value : réponse
// ATTR_ERRMODE : mode de rapport d'erreur ? / ERRMODE_EXCEPTION : lance une PDOexception (erreur par defaut)
// ATTR_DEFAULT_FETCH_MODE : methode de recuperation par defaut ? /  FETCH_ASSOC : tableau associatif

} catch (PDOException $e) {
    die('Erreur: ' . $e->getMessage());
}

?>
