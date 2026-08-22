<?php
if (session_status() === PHP_SESSION_NONE) {
    require_once __DIR__ . '/../../../vendor/autoload.php';
    require_once __DIR__ . '/../../Config/bootstrap.php';
    require_once __DIR__ . '/../../Config/session.php';
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}
?>

<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="csrf-token" content="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display+SC&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/fondation.css">
    <link rel="stylesheet" href="/assets/css/header-footer-nav.css">
    <link rel="stylesheet" href="/assets/css/components.css">

    <?php if (!empty($css_pages)): ?>
        <?php foreach ($css_pages as $css): ?>
            <link rel="stylesheet" href="/assets/css/<?= htmlspecialchars($css) ?>.css">
        <?php endforeach; ?>
    <?php endif; ?>

    <title>Vite & Gourmand</title>
</head>

<body class="body-header" data-role-id="<?= htmlspecialchars($_SESSION['utilisateur']['role_id'] ?? ''); ?>">
<header>
    <div class="header-banner-box">
        <img src="/assets/images/header-banner-bgless.png" class="header-banner" alt="Banniere Vite & Gourmand">
    </div>


    <nav>
        <div class="nav-logo">
            <a href="/index.php">
                <img src="/assets/images/logo1_background_less.png" alt="Vite & Gourmand"/>
            </a>
            <button type="button" class="bouton-nav-hamburger" id="bouton-nav-hamburger">
                <img src="/assets/images/suite.png" alt="Menu">
            </button>
        </div>

        <div class="nav-links">
            <div class="nav-links-menus" id="nav-links-menus">
                <div class="nav-links-principal">
                    <ul>
                        <li>
                            <a href="/menus/menus.php" id="bouton-menus" class="animated-button">
                                <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                                    </path>
                                </svg>
                                <span class="text">Nos menus</span>
                                <span class="circle"></span>
                                <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                                    </path>
                                </svg>
                            </a>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <button class="animated-button" id="bouton-devis">
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
                            </button>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <a href="/panier/mon-panier.php" class="animated-button" id="bouton-panier">
                                <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                    ></path>
                                </svg>
                                <span class="text">Mon panier</span>
                                <span class="circle"></span>
                                <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                    ></path>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>

                <?php if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']['role_id'] == 3): ?>
                    <div class="nav-utilisateur">
                        <div class="profil-box">
                            <button class="bouton-profil" id="btn-profil">
                                <img src="/assets/images/utilisateur.png" class="profil-logo" alt="Mon profil">
                            </button>
                            <div class="dropdown-profil">
                                <a href="/profil/profil-admin.php" class="animated-button" id="btn-admin-administration-panel">
                                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                        ></path>
                                    </svg>
                                    <span class="text">Administration</span>
                                    <span class="circle"></span>
                                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                        ></path>
                                    </svg>
                                </a>
                                <a href="/public/auth/deconnexion.php" class="animated-button" id="btn-admin-deconnexion-panel">
                                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                        ></path>
                                    </svg>
                                    <span class="text">Déconnexion</span>
                                    <span class="circle"></span>
                                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                        ></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                <?php elseif (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']['role_id'] == 2): ?>
                    <div class="nav-utilisateur">
                        <div class="profil-box">
                            <button class="bouton-profil" id="btn-profil">
                                <img src="/assets/images/utilisateur.png" class="profil-logo" alt="Mon profil">
                            </button>
                            <div class="dropdown-profil">
                                <a href="/profil/profil-employe.php" class="animated-button" id="btn-employe-commandes-panel">
                                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                        ></path>
                                    </svg>
                                    <span class="text">Commandes en attente</span>
                                    <span class="circle"></span>
                                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                        ></path>
                                    </svg>
                                </a>
                                <a href="/auth/deconnexion.php" class="animated-button" id="btn-employe-deconnexion-panel">
                                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                        ></path>
                                    </svg>
                                    <span class="text">Déconnexion</span>
                                    <span class="circle"></span>
                                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.17１６Z"
                                        ></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                <?php elseif (isset($_SESSION['utilisateur'])): ?>

                    <div class="nav-utilisateur">
                        <a href="/panier/mon-panier.php" id="icone-panier">
                            <img src="/assets/images/panier.png" class="panier-logo" alt="Panier">
                        </a>
                        <div class="profil-box">
                            <button class="bouton-profil" id="btn-profil">
                                <img src="/assets/images/utilisateur.png" class="profil-logo" alt="Mon profil">
                            </button>
                            <div class="dropdown-profil">
                                <a href="/profil/profil-utilisateur.php" class="animated-button" id="btn-utilisateur-compte-panel">
                                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                        ></path>
                                    </svg>
                                    <span class="text">Mon compte</span>
                                    <span class="circle"></span>
                                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                        ></path>
                                    </svg>
                                </a>
<!--                                <a href="/panier/mon-panier.php" class="animated-button" id="btn-utilisateur-panier-panel">-->
<!--                                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">-->
<!--                                        <path-->
<!--                                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"-->
<!--                                        ></path>-->
<!--                                    </svg>-->
<!--                                    <span class="text">Mon panier</span>-->
<!--                                    <span class="circle"></span>-->
<!--                                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">-->
<!--                                        <path-->
<!--                                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.17１６Z"-->
<!--                                        ></path>-->
<!--                                    </svg>-->
<!--                                </a>-->
                                <a href="/auth/deconnexion.php" class="animated-button" id="btn-utilisateur-deconnexion-panel">
                                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                        ></path>
                                    </svg>
                                    <span class="text">Déconnexion</span>
                                    <span class="circle"></span>
                                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                        ></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                <?php else: ?>
                    <div class="nav-links-principal">
                        <a href="/auth/connexion.php" class="animated-button" id="btn-connexion-index">
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
                        </a>
                    </div>

                <?php endif; ?>
            </div>

        </div>
    </nav>
</header>