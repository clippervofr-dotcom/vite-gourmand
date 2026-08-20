<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../src/Config/root-path.php';
require_once ROOT_PATH . '/src/Config/session.php';
if (!isset($_SESSION['utilisateur'])) {
    header('Location: /auth/connexion.php');
    exit;
}

if ($_SESSION['utilisateur']['role_id'] !== 2) {
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

    <div class="nav-profil-employe" id="nav-profil-employe">
        <button type="button" class="animated-button" id="btn-voir-commandes-employe">
            <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                <path
                        d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                ></path>
            </svg>
            <span class="text">Commandes en cours de validation</span>
            <span class="circle"></span>
            <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                <path
                        d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                ></path>
            </svg>
        </button>
    </div>

    <div class="profil-box-fond">
        <div class="fond-exterieur" id="fond-exterieur-employe"></div>
        <div class="profil-employe-box-commandes active" id="profil-utilisateur-box-commandes">
            <div class="titre-info-perso">
                <img src="../assets/images/commandes-en-attente-de-validation.png" alt="Informations client">
            </div>
            <div class="btn-statut-commande-box">
                <button type="button" class="btn-statut-commande" data-statut="en attente" id="btn-statut-commande-attente">
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
                </button>
                <button type="button" class="btn-statut-commande" data-statut="validée" id="btn-statut-commande-validee">
                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                    <span class="text">Commandes validées</span>
                    <span class="circle"></span>
                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                </button>
                <button type="button" class="btn-statut-commande" data-statut="annulée" id="btn-statut-commande-annulee">
                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                    <span class="text">Commandes Annulées</span>
                    <span class="circle"></span>
                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                </button>
            </div>

            <div class="profil-employe-commandes-liste">
                <div class="profil-employe-commandes-entete">
                    <span>Commande n°</span>
                    <span>Nom du menu</span>
                    <span>Nbr de personnes</span>
                    <span>Date préstation</span>
                    <span>Status</span>
                    <span>Commentaires</span>
                    <span>Détails</span>
                    <span>Validation</span>
                </div>
                <!-- AJOUTE commandes.js ICI -->
            </div>
        </div>
    </div>
</main>


<?php require ROOT_PATH . '/src/Views/partials/footer.php'; ?>

