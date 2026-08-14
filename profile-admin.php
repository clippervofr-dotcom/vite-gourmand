<?php $css_pages = ['profil']; ?>
<?php require 'includes/header.php'; ?>

<?php
$heure = (int) date('H');
$salutation = $heure < 12 ? 'Bonjour' : ($heure < 18 ? 'Bon après-midi' : 'Bonsoir');
?>

<main>
    <!-- NAV ADMIN -->

    <div class="titre-profil-utilisateur" id="titre-profil-utilisateur">
        <h1><?= $salutation ?>, <?= htmlspecialchars($_SESSION['utilisateur']['prenom'], ENT_QUOTES, 'UTF-8') ?> !</h1>
    </div>

    <div class="nav-profil-utilisateur" id="nav-profil-utilisateur">
        <button type="button" class="animated-button" id="btn-nav-admin-liste-employe">
            <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                ></path>
            </svg>
            <span class="text">Compte Employé</span>
            <span class="circle"></span>
            <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                ></path>
            </svg>
        </button>
        <button type="button" class="animated-button" id="btn-nav-admin-commandes">
            <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                ></path>
            </svg>
            <span class="text">Commandes en attente de validation</span>
            <span class="circle"></span>
            <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                ></path>
            </svg>
        </button>
        <button type="button" class="animated-button" id="btn-nav-admin-horaires">
            <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                <path
                        d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                ></path>
            </svg>
            <span class="text">Modification des horaires</span>
            <span class="circle"></span>
            <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                <path
                        d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                ></path>
            </svg>
        </button>
        <button type="button" class="animated-button" id="btn-nav-admin-statistiques">
            <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                ></path>
            </svg>
            <span class="text">Voir statistiques</span>
            <span class="circle"></span>
            <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                ></path>
            </svg>
        </button>
    </div>

    <!-- ADMIN LISTE EMPLOYE -->

    <div class="profil-box-fond">
        <div class="fond-exterieur" id="fond-exterieur-admin"></div>


        <div class="profil-admin-box-liste-employe" id="profil-admin-box-liste-employe">
            <div class="titre-info-perso">
                <img src="assets/images/compte-employe.png" alt="compte employé">
            </div>
            <p class="validation-changement-info"></p>

            <div class="profil-admin-commandes-liste">
                <div class="profil-admin-commandes-entete">
                    <span>Nom</span>
                    <span>Prénom</span>
                    <span>Email</span>
                    <span>Téléphone</span>
                    <span>Rôle</span>
                </div>
                <!-- AJOUTE liste-employe.js ICI -->
            </div>

            <div class="admin-btn-creation-compte">
                <button type="button" class="animated-button" id="btn-creation-employe">
                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                    <span class="text">Créer un compte employé</span>
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
        <!-- ADMIN CREATION COMPTE EMPLOYE -->

    <div class="profil-admin-box-creation-compte" id="profil-admin-box-creation-compte">
        <div class="titre-info-perso">
            <img src="assets/images/creation-compte.png" alt="Création de compte employé">
        </div>
        <p class="validation-changement-info"></p>
        <div class="first-ligne-info">
            <div class="infos-perso">
                <label for="nom-creation-admin">Nom :</label>
                <input type="text" class="input-profil-utilisateur" id="nom-creation-admin" name="nom-creation-admin"
                       value="" required>
            </div>
            <div class="infos-perso">
                <label for="prenom-creation-admin">Prénom :</label>
                <input type="text" class="input-profil-utilisateur" id="prenom-creation-admin"
                       name="prenom-creation-admin" value="" required>
            </div>
        </div>
        <div class="second-ligne-info">
            <div class="infos-perso">
                <label for="email-creation-admin">Email :</label>
                <input type="email" class="input-profil-utilisateur" id="email-creation-admin"
                       name="email-creation-admin" value="" required>
            </div>
            <div class="infos-perso">
                <label for="telephone-creation-admin">Téléphone :</label>
                <input type="tel" class="input-profil-utilisateur" id="telephone-creation-admin"
                       name="telephone-creation-admin" inputmode="numeric" pattern="[0-9]{10}" maxlength="10" value=""
                       required>
            </div>
        </div>
        <div class="second-ligne-info">
            <div class="infos-perso">
                <label for="code-postal-creation-admin">Code postal :</label>
                <input type="text" class="input-profil-utilisateur" id="code-postal-creation-admin"
                       name="code-postal-creation-admin" inputmode="numeric" pattern="[0-9]{5}" maxlength="5" value=""
                       required>
            </div>
            <div class="infos-perso">
                <label for="ville-creation-admin">Ville :</label>
                <input type="text" class="input-profil-utilisateur" id="ville-creation-admin"
                       name="ville-creation-admin" value="" required>
            </div>
        </div>
        <div class="third-ligne-info">
            <div class="infos-perso">
                <label for="adresse-creation-admin">Adresse :</label>
                <input type="text" class="input-profil-utilisateur" id="adresse-creation-admin"
                       name="adresse-creation-admin" value="" required>
            </div>
        </div>
        <div class="radio-ligne-info">
            <label for="role-creation-admin" class="role-creation-titre">Rôle :</label>
            <div class="radio-creation-employe-box">
                <div>
                    <label for="radio-employe">Employé</label>
                    <input type="radio" class="input-profil-utilisateur" id="radio-employe" name="role-creation-admin"
                           value="employe" checked>
                </div>
                <div>
                    <label for="radio-admin">Administrateur</label>
                    <input type="radio" class="input-profil-utilisateur" id="radio-admin" name="role-creation-admin"
                           value="admin">
                </div>
            </div>
        </div>
        <div class="btn-profil-utilisateur-modif">
            <button type="button" class="animated-button" id="btn-creation-employe-valider">
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
            <button type="button" class="animated-button" id="btn-creation-employe-annuler">
                <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                    ></path>
                </svg>
                <span class="text">Quitter</span>
                <span class="circle"></span>
                <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                    ></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- ADMIN VOIR COMMANDES EN COURS -->
    <div class="profil-box-fond">
        <div class="fond-exterieur" id="fond-exterieur-admin-commande"></div>
        <div class="profil-employe-box-commandes active" id="profil-admin-box-commandes">
            <div class="titre-info-perso">
                <img src="assets/images/commandes-en-attente-de-validation.png" alt="Informations client">
            </div>
            <div class="btn-statut-commande-box">
                <button type="button" class="btn-statut-commande" data-statut="en attente"
                        id="btn-statut-commande-attente">
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
                <button type="button" class="btn-statut-commande" data-statut="validée"
                        id="btn-statut-commande-validee">
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
                <button type="button" class="btn-statut-commande" data-statut="annulée"
                        id="btn-statut-commande-annulee">
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
                    <span>Annulation</span>
                </div>
                <!-- AJOUTE commandes.js ICI -->
            </div>
        </div>
    </div>


    <!-- MODIF HORAIRES -->
    <div class="profil-box-fond">
        <div class="fond-exterieur" id="fond-exterieur-admin-horaire"></div>
        <div class="profil-admin-box-modif-horaire" id="profil-admin-box-modif-horaire">
            <div class="titre-info-perso">
                <img src="assets/images/modification-horaire.png" alt="Création de compte employé">
            </div>
            <span class="validation-change-horaire"></span>

            <span class="modification-horaire-info"></span>

            <div class="first-ligne-info">

                <div class="modifications-horaires">
                    <span class="modif-jour-titre"></span>
                    <span class="modif-ouverture-titre">Heure d'ouverture :</span>
                    <span class="modif-fermeture-titre">Heure de fermeture :</span>


                    <span class="jour-titre">Lundi :</span>
                    <input type="time" class="input-profil-utilisateur" id="modif-ouverture-lundi"
                           name="modif-ouverture-lundi" value="" step="1800">
                    <input type="time" class="input-profil-utilisateur" id="modif-fermeture-lundi"
                           name="modif-fermeture-lundi" value="" step="1800">

                    <span class="jour-titre">Mardi :</span>
                    <input type="time" class="input-profil-utilisateur" id="modif-ouverture-mardi"
                           name="modif-ouverture-mardi" value="" step="1800">
                    <input type="time" class="input-profil-utilisateur" id="modif-fermeture-mardi"
                           name="modif-fermeture-mardi" value="" step="1800">

                    <span class="jour-titre">Mercredi :</span>
                    <input type="time" class="input-profil-utilisateur" id="modif-ouverture-mercredi"
                           name="modif-ouverture-mercredi" value="" step="1800">
                    <input type="time" class="input-profil-utilisateur" id="modif-fermeture-mercredi"
                           name="modif-fermeture-mercredi" value="" step="1800">

                    <span class="jour-titre">Jeudi :</span>
                    <input type="time" class="input-profil-utilisateur" id="modif-ouverture-jeudi"
                           name="modif-ouverture-jeudi" value="" step="1800">
                    <input type="time" class="input-profil-utilisateur" id="modif-fermeture-jeudi"
                           name="modif-fermeture-jeudi" value="" step="1800">

                    <span class="jour-titre">Vendredi :</span>
                    <input type="time" class="input-profil-utilisateur" id="modif-ouverture-vendredi"
                           name="modif-ouverture-vendredi" value="" step="1800">
                    <input type="time" class="input-profil-utilisateur" id="modif-fermeture-vendredi"
                           name="modif-fermeture-vendredi" value="" step="1800">

                    <span class="jour-titre">Samedi :</span>
                    <input type="time" class="input-profil-utilisateur" id="modif-ouverture-samedi"
                           name="modif-ouverture-samedi" value="" step="1800">
                    <input type="time" class="input-profil-utilisateur" id="modif-fermeture-samedi"
                           name="modif-fermeture-samedi" value="" step="1800">
                </div>
            </div>
            <div class="btn-modif-horaire">
                <button type="button" class="animated-button" id="btn-modif-horaire-valider">
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
    </div>

    <!-- ADMIN STATISTIQUES -->
    <div class="profil-box-fond">
        <div class="fond-exterieur" id="fond-exterieur-admin-commande"></div>
        <div class="profil-admin-box-voir-statistiques" id="profil-admin-box-voir-statistiques">
            <div class="titre-info-perso">
                <img src="assets/images/voir-stats.png" alt="Statistiques">
            </div>

            <div class="admin-selecteur-stats">
                <div class="first-ligne-periode">
                    <label for="periode-stats-admin">Période :</label>
                    <select id="periode-stats-admin" name="periode-stats-admin">
                        <option value="Tous">Tous</option>
                        <option value="01">Janvier</option>
                        <option value="02">Février</option>
                        <option value="03">Mars</option>
                        <option value="04">Avril</option>
                        <option value="05">Mai</option>
                        <option value="06">Juin</option>
                        <option value="07">Juillet</option>
                        <option value="08">Aout</option>
                        <option value="09">Septembre</option>
                        <option value="10">Octobre</option>
                        <option value="11">Novembre</option>
                        <option value="12">Decembre</option>
                    </select>
                </div>
            </div>

            <div class="admin-rapport-stats">
                <div class="admin-rapport-note-moyenne">
                    <label>Note moyenne</label>
                    <span id="note-moyenne" data-label="note moyenne"></span>
                </div>
                <div class="admin-rapport-taux-annulation">
                    <label>Taux d'annulation<br> global</label>
                    <span id="taux-annulation" data-label="taux d'annulation"></span>
                </div>
                <div class="admin-rapport-commandes-validees">
                    <label>Commandes Totales:</label>
                    <div class="admin-rapport-commandes-validees-liste">
                        <span id="nbr-commandes-by-statut-name-en-attente"></span><span>---></span><span id="nbr-commandes-by-statut-en-attente" data-label="commandes en attente"></span>
                        <span id="nbr-commandes-by-statut-name-validee"></span><span>---></span><span id="nbr-commandes-by-statut-validee" data-label="commandes validées"></span>
                        <span id="nbr-commandes-by-statut-name-terminee"></span><span>---></span><span id="nbr-commandes-by-statut-terminee" data-label="commandes terminées"></span>
                        <span id="nbr-commandes-by-statut-name-annulee"></span><span>---></span><span id="nbr-commandes-by-statut-annulee" data-label="commandes annulées"></span>
                    </div>

                </div>
                <div class="admin-rapport-ca-total">
                    <label>CA Total</label>
                    <span id="ca-total" data-label="CA total"></span>
                </div>
            </div>

            <div class="statistiques-titre">
                <span id="details-commandes-du-mois"></span>
            </div>
            <div class="profil-admin-container">
                <div class="profil-admin-statistiques-liste">
                    <span>Noms des menus</span>
                    <span>Commandes<br> en attente</span>
                    <span>Commandes validées</span>
                    <span>Commandes terminées</span>
                    <span>Commandes annulées</span>
                    <span>Commandes totales</span>
                    <span>Taux d'annulation</span>
                    <span>CA par commandes</span>
                </div>
                <!-- ICI JS STATS -->
            </div>
            <div class="mois-montant-total">
                <span>Montant CA total du mois :</span>
                <span id="montant-ca-total-mois"></span>
            </div>
        </div>
    </div>

</main>

<?php require 'includes/footer.php'; ?>

