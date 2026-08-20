<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../src/Config/bootstrap.php';
require_once ROOT_PATH . '/src/Config/session.php';
require ROOT_PATH . '/src/Security/csrf.php';

use Controllers\HorairesController;
use Entities\Horaires;
use Repositories\HorairesRepositoryMysql;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Mauvaise méthode.']);
    exit;
}

if (!isset($_SESSION['utilisateur'])) {
    echo json_encode(['success' => false, 'message' => 'Non connecté.']);
    exit;
}

if (!($_SESSION['utilisateur']['role_id'] === 3)) {
    echo json_encode(['success' => false, 'message' => 'Droits insuffisants.']);
    exit;
}

verifierCsrf();

$jours = [
    1 => 'lundi', 2 => 'mardi', 3 => 'mercredi',
    4 => 'jeudi', 5 => 'vendredi', 6 => 'samedi'
];

foreach ($jours as $nomJour) {
    if (!isset($_POST[$nomJour . '-ouverture']) || !isset($_POST[$nomJour . '-fermeture'])) {
        echo json_encode(['success' => false, 'message' => "Données horaires manquantes pour $nomJour."]);
        exit;
    }
}

$horairesRepository = new HorairesRepositoryMysql($pdo);
$horairesController = new HorairesController($horairesRepository);

foreach ($jours as $horaireId => $nomJour) {
    $ouverture = $_POST[$nomJour . '-ouverture'] ?? '';
    $fermeture = $_POST[$nomJour . '-fermeture'] ?? '';

    $horaires = new Horaires(
        jour : $nomJour,
        heureOuverture: $ouverture,
        heureFermeture: $fermeture,
        horaireId: $horaireId
    );
    $horairesController->save($horaires);
}
echo json_encode(['success' => true]);

