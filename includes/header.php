<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display+SC&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Vite & Gourmand</title>
</head>

<body>
<header>
    <nav>
        <div class="nav-logo">
            <a href="index.php">
                <img src="assets/images/logo1_background_less.png" alt="Vite & Gourmand"/>
            </a>
            <a href="index.php">Vite & Gourmand</a>
        </div>
        <div class="nav-links">
            <div class="nav-links-menu-contact">
                <ul>
                    <li><a href="menus.php" class="bouton-menus-header">Nos menus</a></li>
                </ul>
                <ul>
                    <li><a href="contact.php" class="bouton-contact">Faire un devis</a></li>
                </ul>
            </div>



        <?php if (isset($_SESSION['utilisateur'])): ?>

            <div class="nav-utilisateur">
                <a href="panier.php">
                 <img src="assets/images/panier.png" class="panier-logo" alt="Panier">
                </a>
                <div class="profil-box">
                    <button class="bouton-profil">
                        <img src="assets/images/utilisateur.png" class="profil-logo" alt="Mon profil">
                    </button>
                    <div class="dropdown-profil">
                        <a href="profil.php">Mon profil</a>
                        <a href="commandes.php">Mes commandes</a>
                        <a href="deconnexion.php">Déconnexion</a>
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>

        <a href="connexion.php" class="bouton-connexion">Connexion</a>

        <?php endif; ?>

    </nav>
</header>