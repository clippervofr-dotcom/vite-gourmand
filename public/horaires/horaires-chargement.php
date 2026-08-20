<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../src/Config/bootstrap.php';
require_once ROOT_PATH . '/src/Config/session.php';

use Controllers\HorairesController;
use Repositories\HorairesRepositoryMysql;

header('Content-Type: application/json');

$horairesRepository = new HorairesRepositoryMysql($pdo);
$horairesController = new HorairesController($horairesRepository);

$toutLesHorairesTrier = $horairesController->getByOrderedId();

echo json_encode($toutLesHorairesTrier);

