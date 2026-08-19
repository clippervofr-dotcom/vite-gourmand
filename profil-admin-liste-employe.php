<?php
session_start();

use Controllers\UtilisateurController;
use includes\Autoloader;
use Repositories\RoleRepositoryMysql;
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

if (!($_SESSION['utilisateur']['role_id'] === 3)) {
    echo json_encode(['success' => false, 'message' => 'Authorisation insuffisante.']);
    exit;
}

verifierCsrf();

$roleRepository = new RoleRepositoryMysql($pdo);
$utilisateurRepository = new UtilisateurRepositoryMysql($pdo);
$utilisateurController = new UtilisateurController($utilisateurRepository);

$roleId = 2; // role Employé
$employes = [];

$listeEmploye = $utilisateurController->listeUtilisateurByRole($roleId);
if ($listeEmploye) {
    foreach ($listeEmploye as $employe) {
        $role = $roleRepository->getById($employe->getRoleId());
        if (!$role) {
            error_log('Role introuvable');
        }
        $employes[] = [
            'nom' => $employe->getNom(),
            'prenom' => $employe->getPrenom(),
            'telephone' => $employe->getTelephone(),
            'email' => $employe->getEmail(),
            'libelle' => $role ? $role->getLibelle() : null,
        ];
    }
}
echo json_encode($employes);