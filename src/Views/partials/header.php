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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tarteaucitronjs/1.34.0/tarteaucitron.min.js"></script>
    <script type="text/javascript">
        tarteaucitron.init({
            "privacyUrl": "", /* Url de la politique de confidentialité */
            "bodyPosition": "top", /* top place le bandeau de consentement au début du code html, mieux pour l'accessibilité */

            "hashtag": "#tarteaucitron", /* Hashtag qui permet d'ouvrir le panneau de contrôle  */
            "cookieName": "tarteaucitron", /* Nom du cookie (uniquement lettres et chiffres) */

            "orientation": "middle", /* Position de la bannière (top - bottom - popup - banner) */

            "groupServices": true, /* Grouper les services par catégorie */
            "showDetailsOnClick": true, /* Cliquer pour ouvrir la description */
            "serviceDefaultState": "wait", /* Statut par défaut (true - wait - false) */

            "showAlertSmall": false, /* Afficher la petite bannière en bas à droite */
            "showTitleBanner": false, /* Afficher le titre dans le bandeau haut/bas */
            "cookieslist": false, /* Afficher la liste des cookies via une mini bannière */
            "cookieslistEmbed": false, /* Afficher la liste des cookies dans le panneau de contrôle */

            "closePopup": true, /* Afficher un X pour fermer la bannière */

            "showIcon": true, /* Afficher un cookie pour ouvrir le panneau */
            //"iconSrc": "", /* Optionnel: URL ou image en base64 */
            "iconPosition": "BottomRight", /* Position de l'icons: (BottomRight - BottomLeft - TopRight - TopLeft) */

            "adblocker": false, /* Afficher un message si un Adblocker est détecté */

            "DenyAllCta" : true, /* Afficher le bouton Tout refuser */
            "AcceptAllCta" : true, /* Afficher le bouton Tout accepter */
            "highPrivacy": true, /* Attendre le consentement */
            "alwaysNeedConsent": false, /* Demander le consentement même pour les services "Privacy by design" */

            "handleBrowserDNTRequest": false, /* Refuser tout par défaut si Do Not Track est activé sur le navigateur */

            "removeCredit": false, /* Retirer le lien de crédit vers tarteaucitron.io */
            "moreInfoLink": true, /* Afficher le lien En savoir plus */

            "useExternalCss": false, /* Mode expert : désactiver le chargement des fichiers .css tarteaucitron */
            "useExternalJs": false, /* Mode expert : désactiver le chargement des fichiers .js tarteaucitron */

            //"cookieDomain": ".my-multisite-domaine.fr", /* Optionnel: domaine principal pour partager le consentement avec des sous domaines */

            "readmoreLink": "", /* Changer le lien En savoir plus par défaut */

            "mandatory": true, /* Afficher un message pour l'utilisation de cookies obligatoires */
            "mandatoryCta": false, /* Afficher un bouton pour les cookies obligatoires (déconseillé) */

            //"customCloserId": "", /* Optionnel a11y: ID personnalisé pour ouvrir le panel */

            "googleConsentMode": true, /* Activer le Google Consent Mode v2 pour Google ads & GA4 */
            "bingConsentMode": true, /* Activer le Bing Consent Mode pour Clarity & Bing Ads */
            "pianoConsentMode": true, /* Activer le Consent Mode pour Piano Analytics */
            "pianoConsentModeEssential": false, /* Activer par défaut le mode Essential de Piano */
            "softConsentMode": false, /* Soft consent mode (le consentement est requis pour charger les tags) */

            "dataLayer": false, /* Envoyer un événement dans dataLayer avec le statut des services */
            "serverSide": false, /* Server side seulement, les tags ne sont pas chargé côté client */

            "partnersList": true /* Afficher le détail du nombre de partenaires sur la bandeau */
        });
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="csrf-token" content="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self';
     script-src 'self' https://kit.fontawesome.com https://cdnjs.cloudflare.com 'sha256-U8wlvgw0OvxSJXpCTzuHalTGhjwlyQ56mLf5bBL3mQU=' 'sha256-eUSsXIzUT+4e3V/MOEFkSIuabPsFPDuT2uYCICM8oLI=' 'sha256-IBogtgg3kdZZKyjwNG/+RfZtF3+SB4M2+6gnCVALMvw=' 'sha256-Z2mYiAfi6ZC9loMnPJ9FdH9GavK9hYuDrs7lO4vOar0=';
     style-src 'self' https://fonts.googleapis.com https://cdnjs.cloudflare.com 'sha256-kdaXPEOwTw3zyiuCzGv1vpohcW9SqOWq8k6gy2OWgtI=' 'sha256-FYY/SGpsd0pQtx3CdPyEn3hkd5YRpeboCePbd04JAXM=' 'unsafe-hashes' 'sha256-/QSh0DyKZIE4f71NhHmeRGlq3RQ7ZHQa1WQMbcA7ufY=' 'sha256-DlfzhjqBiDbZLp9LIFuCkF9v89PG/vrOQpqOYb9NvHU=';
     font-src 'self' https://fonts.gstatic.com;
     img-src 'self' data:;
     connect-src 'self' https://ka-f.fontawesome.com;
     frame-src https://www.google.com;
     object-src 'none';
     base-uri 'self';
     form-action 'self';">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display+SC&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1860391289.js" crossorigin="anonymous"></script>
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
                    <ul class="nav-utilisateur">
                        <li class="profil-box">
                            <a href="/profil/profil-admin.php" class="animated-button"
                               id="btn-admin-administration-panel">
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
                            <a href="/auth/deconnexion.php" class="animated-button"
                               id="btn-admin-deconnexion-panel">
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
                        </li>
                    </ul>

                <?php elseif (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']['role_id'] == 2): ?>
                    <ul class="nav-utilisateur">
                        <li>
                            <a href="/profil/profil-employe.php" class="animated-button"
                               id="btn-employe-commandes-panel">
                                <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                    ></path>
                                </svg>
                                <span class="text">Commandes</span>
                                <span class="circle"></span>
                                <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                    ></path>
                                </svg>
                            </a>
                            <a href="/auth/deconnexion.php" class="animated-button"
                               id="btn-employe-deconnexion-panel">
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
                        </li>
                    </ul>

                <?php elseif (isset($_SESSION['utilisateur'])): ?>
                    <ul class="nav-utilisateur">
                        <li>
                            <a href="/profil/profil-utilisateur.php" class="animated-button"
                               id="btn-utilisateur-compte-panel">
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
                            <a href="/auth/deconnexion.php" class="animated-button"
                               id="btn-utilisateur-deconnexion-panel">
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
                        </li>
                    </ul>

                <?php else: ?>
                    <div class="nav-links-principal btn-nav-connexion">
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