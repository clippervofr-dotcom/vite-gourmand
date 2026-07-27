<?php
require 'includes/db.php';

if (!isset($_SESSION['utilisateur'])) {
    echo json_encode([]);
    header('Location: connexion.php');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //selection menu
    if(filter_has_var(INPUT_POST, 'choix-menu')) {
        $menu_id = htmlspecialchars($_POST['choix-menu']);
    } else {
        $menu_id = null;
    }

    $stmt_menu = $pdo->prepare('
        SELECT commande.menu_id
        FROM commande
        JOIN menu ON commande.menu_id = menu.menu_id
        WHERE $menu_id = menu.menu_id;');


    $stmt = $pdo->prepare('
INSERT INTO commande (utilisateur_id, nom, prenom, adresse, code_postal, ville, telephone, email, date_prestation, menu_id, nombre_personnes, pret_materiel) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');

    $stmt->execute([
        $_SESSION['utilisateur']['utilisateur_id'],
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['adresse'],
        $_POST['code-postal'],
        $_POST['ville'],
        $_POST['telephone'],
        $_POST['email'],
        $_POST['date-heure'],

        $_POST['choix-menu'],
        $_POST['nbr-personnes-commande'],
        $_POST['matériel'],
    ]);



    header('location: index.php');
    exit;
} else {
    $erreur = "Les mots de passe ne correspondent pas.";
}

//

//$adresse = colonne : adresse + code_postal + ville
//numero_commande =
//$_POST['choix-menu'] = menu_id