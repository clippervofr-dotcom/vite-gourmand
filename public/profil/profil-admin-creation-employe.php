<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../src/Config/bootstrap.php';
require_once ROOT_PATH . '/src/Config/session.php';
require ROOT_PATH . '/src/Security/csrf.php';

use Controllers\UtilisateurController;
use Entities\Utilisateur;
use Repositories\UtilisateurRepositoryMysql;

header('Content-Type: application/json');

$utilisateurRepository = new UtilisateurRepositoryMysql($pdo);
$utilisateurController = new UtilisateurController($utilisateurRepository);

if (!isset($_SESSION['utilisateur'])) {
    echo json_encode(['success' => false, 'message' => 'Non connecté.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Mauvaise méthode.']);
    exit;
}

if ($_SESSION['utilisateur']['role_id'] !== 3) {
    echo json_encode(['success' => false, 'message' => 'Accès refusé.']);
    exit;
}

verifierCsrf();

$nom = trim($_POST['nom'] ?? null);
$prenom = trim($_POST['prenom'] ?? null);
$email = trim($_POST['email'] ?? null);
$ville = trim($_POST['ville'] ?? null);
$adresse = trim($_POST['adresse'] ?? null);
$role_input = trim($_POST['role'] ?? null);
$role = 0;
$actif = true;

if ($role_input === 'admin') {
    $role = 3;
} else if ($role_input === 'employe') {
    $role = 2;
} else {
    echo json_encode(['success' => false, 'message' => 'Rôle invalide.']);
    exit;
}

$emailValide = filter_var($email, FILTER_VALIDATE_EMAIL);
if (!$emailValide) {
    echo json_encode(['success' => false, 'message' => 'Email invalide.']);
    exit;
}

$telephone = trim($_POST['telephone'] ?? null);
$telephoneValide = preg_match('/^[0-9]{10}$/', $telephone);
if (!$telephoneValide) {
    echo json_encode(['success' => false, 'message' => 'Téléphone invalide.']);
    exit;
}

$codePostal = trim($_POST['code_postal'] ?? null);
$codePostalValide = preg_match('/^[0-9]{5}$/', $codePostal);
if (!$codePostalValide) {
    echo json_encode(['success' => false, 'message' => 'Code postal invalide.']);
    exit;
}

$newEmploye = new Utilisateur(null, $nom, $prenom, $email, $telephone, $adresse, $ville, $codePostal, $actif, $role);

$utilisateur = $utilisateurController->ajouterEmployeAvecMotDePasse($newEmploye);
if ($utilisateur['success']) {
    echo json_encode(['success' => true, 'message' => 'Employé créé avec succès. Mot de passe généré : ' . $utilisateur['mot_de_passe']]);
} else {
    echo json_encode(['success' => false, 'message' => $utilisateur['message']]);
}








