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
                    <li><a href="menus.php" class="boutons-header">
                            <button class="animated-button">
                                <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                    ></path>
                                </svg>
                                <span class="text">Nos menus</span>
                                <span class="circle"></span>
                                <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                    ></path>
                                </svg>
                            </button>
                        </a></li>
                </ul>
                <ul>
                    <li><button class="animated-button" id="bouton-devis">
                            <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                ></path>
                            </svg>
                            <span class="text">Faire un devis</span>
                            <span class="circle"></span>
                            <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                ></path>
                            </svg>
                        </button></li>
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
                    <a href="connexion.php" class="bouton-connexion">
                        <button class="animated-button">
                            <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                ></path>
                            </svg>
                            <span class="text">Connexion</span>
                            <span class="circle"></span>
                            <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                ></path>
                            </svg>
                        </button>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>