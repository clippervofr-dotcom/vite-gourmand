<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../src/Config/root-path.php';
require_once ROOT_PATH . '/src/Config/session.php';
if (!isset($_SESSION['utilisateur'])) {
    header('Location: /auth/connexion.php');
    exit;
}

if ($_SESSION['utilisateur']['role_id'] !== 1) {
    header('Location: /index.php');
    exit;
}
?>



<?php $css_pages = ['profil']; ?>
<?php require ROOT_PATH . '/src/Views/partials/header.php'; ?>

<?php
$heure = (int) date('H');
$salutation = $heure < 12 ? 'Bonjour' : ($heure < 18 ? 'Bon après-midi' : 'Bonsoir');
?>

<main>
    <div class="titre-profil-utilisateur" id="titre-profil-utilisateur">
        <h1><?= $salutation ?>, <?= htmlspecialchars($_SESSION['utilisateur']['prenom'], ENT_QUOTES, 'UTF-8') ?> !</h1>
    </div>
    <div class="nav-profil-utilisateur" id="nav-profil-utilisateur">
        <button type="button" class="animated-button" id="btn-info-perso-utilisateur">
            <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                ></path>
            </svg>
            <span class="text">Infos Personnelles</span>
            <span class="circle"></span>
            <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                ></path>
            </svg>
        </button>
        <button type="button" class="animated-button" id="btn-profil-commandes-utilisateur">
            <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                ></path>
            </svg>
            <span class="text">Mes commandes</span>
            <span class="circle"></span>
            <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                ></path>
            </svg>
        </button>
    </div>

    <div class="profil-box-fond">
        <div class="fond-exterieur"></div>

        <!-- PROFIL INFO UTILISATEUR -->

        <form class="profil-utilisateur-box-info-perso active" id="profil-utilisateur-box-info-perso" action="" method="post">
            <div class="titre-info-perso">
                <img src="../assets/images/info-client.png" alt="Informations client">
            </div>
            <p class="validation-changement-info"></p>
            <div class="first-ligne-info">
                <div class="infos-perso">
                    <label for="nom-profil-utilisateur">Nom :</label>
                    <input type="text" class="input-profil-utilisateur" id="nom-profil-utilisateur" name="nom-profil-utilisateur" maxlength="50" pattern="^\b(?:\w|-)+\b$" value="" disabled>
                </div>
                <div class="infos-perso">
                    <label for="prenom-profil-utilisateur">Prénom :</label>
                    <input type="text" class="input-profil-utilisateur" id="prenom-profil-utilisateur" name="prenom-profil-utilisateur" maxlength="50" pattern="^\b(?:\w|-)+\b$" value="" disabled>
                </div>
            </div>
            <div class="second-ligne-info">
                <div class="infos-perso">
                    <label for="email-profil-utilisateur">Email :</label>
                    <input type="email" class="input-profil-utilisateur" id="email-profil-utilisateur" name="email-profil-utilisateur" maxlength="100" pattern="^[a-z0-9!#$%&'*+\/=?^_`\{\|\}~\-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`\{\|\}~\-]+)*@(?:[a-z0-9](?:[a-z0-9\-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9\-]*[a-z0-9])?$"

                           value="" disabled>
                </div>
                <div class="infos-perso">
                    <label for="telephone-profil-utilisateur">Téléphone :</label>
                    <input type="tel" class="input-profil-utilisateur" id="telephone-profil-utilisateur" name="telephone-profil-utilisateur"  inputmode="numeric" pattern="^[0-9]{10}$" maxlength="10" value="" disabled>
                </div>
            </div>
            <div class="fourth-ligne-info">
                <div class="infos-perso">
                    <label for="adresse-profil-utilisateur">Adresse :</label>
                    <input type="text" class="input-profil-utilisateur" id="adresse-profil-utilisateur" name="adresse-profil-utilisateur" maxlength="150" value="" disabled>
                </div>
            </div>
            <div class="fourth-ligne-info">
                <div class="infos-perso">
                    <label for="code-postal-profil-utilisateur">Code Postal :</label>
                    <input type="text" class="input-profil-utilisateur" id="code-postal-profil-utilisateur" name="code-postal-profil-utilisateur" inputmode="numeric" pattern="^[0-9]{5}$" maxlength="5" value="" disabled>
                </div>
                <div class="infos-perso">
                    <label for="ville-profil-utilisateur">Ville :</label>
                    <input type="text" class="input-profil-utilisateur" id="ville-profil-utilisateur" name="ville-profil-utilisateur" maxlength="50" pattern="^\b(?:\w|-)+\b$" value="" disabled>
                </div>
            </div>
            <div class="btn-profil-utilisateur-modif">
                <button type="button" class="animated-button" id="btn-profil-utilisateur-modif">
                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                    <span class="text">Modifier</span>
                    <span class="circle"></span>
                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                </button>
                <button type="button" class="animated-button" id="btn-profil-utilisateur-valider">
                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                    <span class="text">Valider</span>
                    <span class="circle"></span>
                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                </button>
            </div>
        </form>

        <!-- PROFIL COMMANDES UTILISATEUR -->

        <div class="profil-utilisateur-box-commandes" id="profil-utilisateur-box-commandes">
            <div class="titre-info-perso">
                <img src="../assets/images/mes-commandes.png" alt="Informations client">
            </div>

            <span class="validation-avis"></span>
            <div class="profil-utilisateur-commandes-liste">
                <div class="profil-utilisateur-commandes-entete">
                    <button type="button" class="user-commande-numero" data-tri="numero">
                        Commande n°<span class="fleche-tri-numero fleche" aria-hidden="true"></span>
                    </button>
                    <button type="button" class="user-nom-menu" data-tri="menu">
                        Nom du menu<span class="fleche-tri-titre fleche" aria-hidden="true"></span>
                    </button>
                    <button type="button" class="user-nbr-personnes" data-tri="menu">
                        Nbr de personnes<span class="fleche-tri-nbr fleche" aria-hidden="true"></span>
                    </button>
                    <button type="button" class="user-nbr-personnes" data-tri="menu">
                        Nbr de personnes<span class="fleche-tri-nbr fleche" aria-hidden="true"></span>
                    </button>
                    <button type="button" class="user-date-prestation" data-tri="menu">
                        Date préstation<span class="fleche-tri-date fleche" aria-hidden="true"></span>
                    </button>
                    <button type="button" class="user-statut" data-tri="menu">
                        Statut<span class="fleche-tri-statut fleche" aria-hidden="true"></span>
                    </button>
                    <span class="user-commentaires">Commentaires</span>
                </div>
                <!-- JS apparait ici -->
            </div>
        </div>
    </div>
</main>

<?php require ROOT_PATH . '/src/Views/partials/footer.php'; ?>
