<?php
// HorairesRepositoryControler.php
require_once 'bootstrap-db.php';
require_once 'bootstrap-Horaires.php'


$horaireRepository = new HorairesRepositoryMysql($pdo);

try {
    $tousLesHoraires = $horaireRepository->getAll();
} catch (PDOException $e) {
    error_log($e->getMessage()); 
    $tousLesHoraires = [];
    $erreurAffichage = "Impossible de charger les horaires pour le moment.";
}

echo json_encode($tousLesHoraires);
?>