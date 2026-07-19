<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display+SC&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fondation.css">
    <link rel="stylesheet" href="assets/css/header-footer-nav.css">
    <link rel="stylesheet" href="assets/css/components.css">

    <?php if (!empty($css_pages)): ?>
        <?php foreach ($css_pages as $css): ?>
            <link rel="stylesheet" href="assets/css/<?= htmlspecialchars($css) ?>.css">
        <?php endforeach; ?>
    <?php endif; ?>

    <title>Vite & Gourmand</title>
</head>

<body>
<header>
    <img src="assets/images/header-banner-bgless.png" class="header-banner">
    <nav>
        <div class="nav-logo">
            <a href="index.php">
                <img src="assets/images/logo1_background_less.png" alt="Vite & Gourmand"/>
            </a>
        </div>
        <div class="nav-links">
            <button type="button" class="bouton-nav-hamburger" id="bouton-nav-hamburger">
                <img src="assets/images/suite.png" alt="Menu">
            </button>
            <div class="nav-links-menus" id="nav-links-menus">
                <ul>
                    <li><a href="menus.php" class="boutons-header">Nos menus</a></li>
                </ul>
                <ul>
                    <li><button type="button" id="bouton-devis" class="boutons-header">Faire un devis</button></li>
                </ul>

                <?php if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']['role_id'] == 3): ?>
                    <div class="nav-utilisateur">
                        <div class="profil-box">
                            <button class="bouton-profil" id="btn-profil">
                                <img src="assets/images/utilisateur.png" class="profil-logo" alt="Mon profil">
                            </button>
                            <div class="dropdown-profil">
                                <a href="administration.php">Administration</a>
                                <a href="commandes-en-attente.php">Commandes</a>
                                <a href="panel-statistiques.php">Voir Stats</a>
                                <a href="deconnexion.php">Déconnexion</a>
                            </div>
                        </div>
                    </div>

                <?php elseif (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']['role_id'] == 2): ?>
                    <div class="nav-utilisateur">
                        <div class="profil-box">
                            <button class="bouton-profil" id="btn-profil">
                                <img src="assets/images/utilisateur.png" class="profil-logo" alt="Mon profil">
                            </button>
                            <div class="dropdown-profil">
                                <a href="espace-employe.php">Espace employé</a>
                                <a href="commandes-en-cours.php">Commandes en cours</a>
                                <a href="deconnexion.php">Déconnexion</a>
                            </div>
                        </div>
                    </div>

                <?php elseif (isset($_SESSION['utilisateur'])): ?>

                    <div class="nav-utilisateur">
                        <a href="panier.php">
                            <img src="assets/images/panier.png" class="panier-logo" alt="Panier">
                        </a>
                        <div class="profil-box">
                            <button class="bouton-profil" id="btn-profil">
                                <img src="assets/images/utilisateur.png" class="profil-logo" alt="Mon profil">
                            </button>
                            <div class="dropdown-profil">
                                <a href="profil.php">Mon profil</a>
                                <a href="mes-commandes.php">Mes commandes</a>
                                <a href="deconnexion.php">Déconnexion</a>
                            </div>
                        </div>
                    </div>

                <?php else: ?>
                <a href="connexion.php" class="bouton-connexion">Connexion</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <img src="assets/images/banner-delimitation.png" class="banner-delimitation">
</header>