<?php $css_pages = ['profil']; ?>
<?php require 'includes/header.php'; ?>

<?php
$heure = (int) date('H');
$salutation = $heure < 12 ? 'Bonjour' : ($heure < 18 ? 'Bon après-midi' : 'Bonsoir');
?>

<main>
    <div class="titre-profil-utilisateur" id="titre-profil-utilisateur">
        <h1>Bienvenue dans ton profil $employe !</h1>
        <!--        <h1><?= $salutation ?>, <?= htmlspecialchars($_SESSION['utilisateur']['prenom']) ?> !</h1>-->
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
                <img src="assets/images/commandes-en-attente-de-validation.png" alt="Informations client">
            </div>

            <div class="profil-employe-commandes-liste">
                <div class="profil-employe-commandes-entete">
                    <span>Commande n°</span>
                    <span>Nom du menu</span>
                    <span>Nbr de personnes</span>
                    <span>Date préstation</span>
                    <span>Status</span>
                    <span>Commentaires</span>
                    <span>Validation</span>
                </div>


<!--                ICI-->



                <div class="profil-employe-commandes-ligne" role="row">

                    <div class="theme-checkbox">
                        <div class="theme-individual">
                            <label class="checkbox-custom">
                                <input type="checkbox" id="validation-employe">
                                <div class="checkbox-mark"></div>
                                <span class="commandes-champ" data-label="Status"></span>
                            </label>
                        </div>
                    </div>

                    <button type="button" class="animated-button" id="btn-voir-detail-commande-employe">
                        <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                            ></path>
                        </svg>
                        <span class="text">Voir détails</span>
                        <span class="circle"></span>
                        <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                            ></path>
                        </svg>
                    </button>

                </div>
            </div>


            <div class="profil-employe-btn">
                <button type="button" class="animated-button" id="btn-valider-commande-employe">
                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                    <span class="text">Sauvegarder</span>
                    <span class="circle"></span>
                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</main>


<?php require 'includes/footer.php'; ?>

