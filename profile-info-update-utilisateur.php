<?php
session_start();

use Controllers\UtilisateurController;
use Entities\Utilisateur;
use includes\Autoloader;
use Repositories\UtilisateurRepositoryMysql;

require __DIR__ . '/includes/Autoloader.php';
require __DIR__ . '/Bootstraps/bootstrap-db.php';
require __DIR__ . '/includes/csrf.php';
Autoloader::register();
header('Content-Type: application/json');

if (!isset($_SESSION['utilisateur'])) {
    echo json_encode(['success' => false, 'message' => 'Non connecté.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée.']);
    exit;
}

verifierCsrf();

$nom = trim($_POST['nom'] ?? '');
$prenom = trim($_POST['prenom'] ?? '');
$adresse = trim($_POST['adresse'] ?? '');
$ville = trim($_POST['ville'] ?? '');
$codePostal = trim($_POST['code_postal'] ?? '');
$telephone = trim($_POST['telephone'] ?? '');
$email = trim($_POST['email'] ?? '');

if (empty($nom) || empty($prenom) || empty($adresse) || empty($ville) || empty($codePostal) || empty($telephone) || empty($email)) {
    echo json_encode(['success' => false, 'message' => 'Tous les champs sont requis.']);
    exit;
}

$nomValide = preg_match('/^\\b(?:\\w|-)+\\b$/', $nom);
if (!$nomValide) {
    echo json_encode(['success' => false, 'message' => 'Nom invalide.']);
    exit;
}

$prenomValide = preg_match('/^\\b(?:\\w|-)+\\b$/', $prenom);
if (!$prenomValide) {
    echo json_encode(['success' => false, 'message' => 'Prénom invalide.']);
    exit;
}

$adresseValide = mb_strlen($adresse) <= 150;
if (!$adresseValide) {
    echo json_encode(['success' => false, 'message' => 'Adresse trop longue.']);
    exit;
}

$villeValide = preg_match('/^\\b(?:\\w|-)+\\b$/', $ville);
if (!$villeValide) {
    echo json_encode(['success' => false, 'message' => 'Ville invalide.']);
    exit;
}

$codePostalValide = preg_match('/^[0-9]{5}$/', $codePostal);
if (!$codePostalValide) {
    echo json_encode(['success' => false, 'message' => 'Code postal invalide.']);
    exit;
}

$telephoneValide = preg_match('/^[0-9]{10}$/', $telephone);
if (!$telephoneValide) {
    echo json_encode(['success' => false, 'message' => 'Téléphone invalide.']);
    exit;
}

$emailValide = filter_var($email, FILTER_VALIDATE_EMAIL);
if (!$emailValide) {
    echo json_encode(['success' => false, 'message' => 'Email invalide.']);
    exit;
}

$utilisateurRepository = new UtilisateurRepositoryMysql($pdo);
$utilisateurController = new UtilisateurController($utilisateurRepository);

$utilisateur_id = $_SESSION['utilisateur']['utilisateur_id'] ?? null;
$utilisateur = $utilisateurController->trouverUtilisateur((int)$utilisateur_id);
if (!$utilisateur) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur non trouvé.']);
    exit;
}

$updateUtilisateur = new Utilisateur($utilisateur->getId(), $nom, $prenom, $email, $telephone, $adresse, $ville, $codePostal, $utilisateur->getActif(), $utilisateur->getRoleId());

$modifUtilisateur = $utilisateurController->ajouterUtilisateur($updateUtilisateur);
if ($modifUtilisateur['success']) {
    echo json_encode(['success' => true, 'message' => 'Profil mis à jour avec succès.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Erreur lors de la mise à jour du profil.']);
}

