<?php
session_start();
require 'includes/db.php';
header('Content-Type: application/json');

if (isset($_SESSION['utilisateur'])) {
    if ($_SESSION['utilisateur']['role_id'] === 3) {


        $lundiOuverture = $_POST['lundi-ouverture'];
        $lundiFermeture = $_POST['lundi-fermeture'];
        $mardiOuverture = $_POST['mardi-ouverture'];
        $mardiFermeture = $_POST['mardi-fermeture'];
        $mercrediOuverture = $_POST['mercredi-ouverture'];
        $mercrediFermeture = $_POST['mercredi-fermeture'];
        $jeudiOuverture = $_POST['jeudi-ouverture'];
        $jeudiFermeture = $_POST['jeudi-fermeture'];
        $vendrediOuverture = $_POST['vendredi-ouverture'];
        $vendrediFermeture = $_POST['vendredi-fermeture'];
        $samediOuverture = $_POST['samedi-ouverture'];
        $samediFermeture = $_POST['samedi-fermeture'];




        $pdo->beginTransaction();

        try {

            $stmt =$pdo->prepare('UPDATE horaire SET heure_ouverture = ? WHERE horaire_id = ?');
            $stmt->execute([$lundiOuverture, 1]);

            $stmt =$pdo->prepare('UPDATE horaire SET heure_fermeture = ? WHERE horaire_id = ?');
            $stmt->execute([$lundiFermeture, 1]);

            $stmt =$pdo->prepare('UPDATE horaire SET heure_ouverture = ? WHERE horaire_id = ?');
            $stmt->execute([$mardiOuverture, 2]);

            $stmt =$pdo->prepare('UPDATE horaire SET heure_fermeture = ? WHERE horaire_id = ?');
            $stmt->execute([$mardiFermeture, 2]);

            $stmt =$pdo->prepare('UPDATE horaire SET heure_ouverture = ? WHERE horaire_id = ?');
            $stmt->execute([$mercrediOuverture, 3]);

            $stmt =$pdo->prepare('UPDATE horaire SET heure_fermeture = ? WHERE horaire_id = ?');
            $stmt->execute([$mercrediFermeture, 3]);

            $stmt =$pdo->prepare('UPDATE horaire SET heure_ouverture = ? WHERE horaire_id = ?');
            $stmt->execute([$jeudiOuverture, 4]);

            $stmt =$pdo->prepare('UPDATE horaire SET heure_fermeture = ? WHERE horaire_id = ?');
            $stmt->execute([$jeudiFermeture, 4]);

            $stmt =$pdo->prepare('UPDATE horaire SET heure_ouverture = ? WHERE horaire_id = ?');
            $stmt->execute([$vendrediOuverture, 5]);

            $stmt =$pdo->prepare('UPDATE horaire SET heure_fermeture = ? WHERE horaire_id = ?');
            $stmt->execute([$vendrediFermeture, 5]);

            $stmt =$pdo->prepare('UPDATE horaire SET heure_ouverture = ? WHERE horaire_id = ?');
            $stmt->execute([$samediOuverture, 6]);

            $stmt =$pdo->prepare('UPDATE horaire SET heure_fermeture = ? WHERE horaire_id = ?');
            $stmt->execute([$samediFermeture, 6]);

        } catch (Exception $exception) {
            $pdo->rollBack();
            echo 'Erreur : ' . $exception->getMessage();
        }

    } else {
        echo json_encode(['success' => false, 'message' => 'Droits insuffisants.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Non connecté.']);
}