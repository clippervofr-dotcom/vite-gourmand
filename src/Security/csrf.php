<?php

function verifierCsrf(): void
{
    $tokenRecu = $_POST['csrf_token'] ?? '';
    $tokenSession = $_SESSION['csrf_token'] ?? '';

    if (!hash_equals($tokenSession, $tokenRecu)) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Requête invalide.']);
        exit;
    }
}

function verifierCsrfPage(string $redirection = 'connexion.php'): void
{
    $tokenRecu = $_POST['csrf_token'] ?? '';
    $tokenSession = $_SESSION['csrf_token'] ?? '';

    if (!hash_equals($tokenSession, $tokenRecu)) {
        header('Location: ' . $redirection . '?erreur=session_expiree');
        exit;
    }
}