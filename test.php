<?php
$mdp = $_POST['mdp'];
$mdp_confirm = $_POST['mdp-confirm'];

$valide = $mdp === $mdp_confirm;

if ($valide) {
    $mdp_hache = password_hash($mdp, PASSWORD_DEFAULT);
} else {
    $erreur = "Les mots de passe ne correspondent pas.";
}
?>


index
<?php
session_start();
$_SESSION['utilisateur'] = ['nom' => 'Test']; // simule un utilisateur connecté
?>


