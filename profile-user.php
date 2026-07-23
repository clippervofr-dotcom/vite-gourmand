<?php $css_pages = ['profil']; ?>
<?php require 'includes/header.php'; ?>

<?php
$heure = (int) date('H');
$salutation = $heure < 12 ? 'Bonjour' : ($heure < 18 ? 'Bon après-midi' : 'Bonsoir');
?>

<main>
    <div class="titre-profil-utilisateur" id="titre-profil-utilisateur">
        <h1>bienvopisehfoshfvousihvouhsf</h1>
<!--        <h1>--><?php //= $salutation ?><!--, --><?php //= htmlspecialchars($_SESSION['utilisateur']['prenom']) ?><!-- !</h1>-->
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

        <div class="profil-utilisateur-box-info-perso active" id="profil-utilisateur-box-info-perso">
            <div class="titre-info-perso">
                <img src="assets/images/info-client.png" alt="Informations client">
            </div>
            <p class="validation-changement-info"></p>
            <div class="first-ligne-info">
                <div class="infos-perso">
                    <label for="nom-profil-utilisateur">Nom</label>
                    <input type="text" class="input-profil-utilisateur" id="nom-profil-utilisateur" name="nom-profil-utilisateur" placeholder="" autocomplete="family-name" disabled>
                </div>
                <div class="infos-perso">
                    <label for="prénom-profil-utilisateur">Prénom</label>
                    <input type="text" class="input-profil-utilisateur" id="prénom-profil-utilisateur" name="prenom-profil-utilisateur" placeholder="" autocomplete="given-name" disabled>
                </div>
            </div>
            <div class="second-ligne-info">
                <div class="infos-perso">
                    <label for="email-profil-utilisateur">Email</label>
                    <input type="email" class="input-profil-utilisateur" id="email-profil-utilisateur" name="email-profil-utilisateur" placeholder="" autocomplete="email" disabled>
                </div>
                <div class="infos-perso">
                    <label for="telephone-profil-utilisateur">Téléphone</label>
                    <input type="tel" class="input-profil-utilisateur" id="telephone-profil-utilisateur" name="telephone-profil-utilisateur" inputmode="numeric" pattern="[0-9]{10}" maxlength="10" placeholder="" autocomplete="tel" disabled>
                </div>
            </div>
            <div class="third-ligne-info">
                <label for="adresse-profil-utilisateur">Adresse</label>
                <input type="text" class="input-profil-utilisateur" id="adresse-profil-utilisateur" name="adresse-profil-utilisateur" placeholder="" autocomplete="address-line1" disabled>
            </div>
            <div class="fourth-ligne-info">
                <div class="infos-perso">
                    <label for="code-postal-profil-utilisateur">Code Postal</label>
                    <input type="text" class="input-profil-utilisateur" id="code-postal-profil-utilisateur" name="code-postal-profil-utilisateur" inputmode="numeric" pattern="[0-9]{5}" maxlength="5" placeholder="" autocomplete="postal-code" disabled>
                </div>
                <div class="infos-perso">
                    <label for="ville-profil-utilisateur">Ville</label>
                    <input type="text" class="input-profil-utilisateur" id="ville-profil-utilisateur" name="ville-profil-utilisateur" placeholder="" autocomplete="address-level2" disabled>
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
        </div>

        <!-- PROFIL COMMANDES UTILISATEUR -->

        <div class="profil-utilisateur-box-commandes" id="profil-utilisateur-box-commandes">
            <div class="titre-info-perso">
                <img src="assets/images/mes-commandes.png" alt="Informations client">
            </div>

            <div class="profil-utilisateur-commandes-liste">
                <div class="profil-utilisateur-commandes-entete">
                    <span>Commande n°</span>
                    <span>Nom du menu</span>
                    <span>Nbr de personnes</span>
                    <span>Date préstation</span>
                    <span>Status</span>
                    <span>Commentaires</span>
                </div>

                <div class="profil-utilisateur-commandes-ligne" role="row">
                    <span class="commandes-champ" data-label="Commande n°">01</span>
                    <span class="commandes-champ" data-label="Nom du menu">Menu de Noël</span>
                    <span class="commandes-champ" data-label="Nbr de personnes">24</span>
                    <span class="commandes-champ" data-label="Date prestation">25/12/2026</span>
                    <span class="commandes-champ" data-label="Status">En attente de validation</span>
                    <span class="commandes-champ" data-label="Commentaires">—</span>
                    <button type="button" class="animated-button" id="btn-annuler-commande-utilisateur">
                        <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                            ></path>
                        </svg>
                        <span class="text">Annuler la commande</span>
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




    </div>
</main>

<?php require 'includes/footer.php'; ?>
