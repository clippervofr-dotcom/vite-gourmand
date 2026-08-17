<?php
session_start();

use Controllers\HorairesController;
use Repositories\HorairesRepositoryMysql;

use includes\Autoloader;
require __DIR__ . '/includes/Autoloader.php';
require __DIR__ . '/Bootstraps/bootstrap-db.php';
Autoloader::register();
header('Content-Type: application/json');


$horairesRepository = new HorairesRepositoryMysql($pdo);
$horairesController = new HorairesController($horairesRepository);

$toutLesHorairesTrier = $horairesController->getByOrderedId();

echo json_encode($toutLesHorairesTrier);

