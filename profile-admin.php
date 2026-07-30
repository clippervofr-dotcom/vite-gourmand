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
        <button type="button" class="animated-button" id="btn-nav-admin-voir-commandes">
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
        <button type="button" class="animated-button" id="btn-nav-admin-voir-statistiques">
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
                    <span>Employé n°</span>
                    <span>Nom</span>
                    <span>Prénom</span>
                    <span>Email</span>
                    <span>Téléphone</span>
                    <span>Rôle</span>
                    <span>Status</span>
                    <span>Commentaires</span>
                </div>

                <div class="profil-admin-commandes-ligne" role="row">
                    <span class="commandes-champ" data-label="Employé n°">01</span>
                    <span class="commandes-champ" data-label="Nom">Dupont</span>
                    <span class="commandes-champ" data-label="Prénom">Jean</span>
                    <span class="commandes-champ" data-label="Email">jean.dupont@example.com</span>
                    <span class="commandes-champ" data-label="Téléphone">01 23 45 67 89</span>
                    <span class="commandes-champ" data-label="Rôle">Employé</span>
                    <span class="commandes-champ" data-label="Status">Actif</span>
                    <span class="commandes-champ" data-label="Commentaires">—</span>
                </div>
            </div>
            <div class="admin-btn-creation-compte">
                <button type="button" class="animated-button" id="btn-creation-compte-employe">
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

        <!-- ADMIN CREATION COMPTE EMPLOYE -->

        <div class="profil-admin-box-creation-compte" id="profil-admin-box-creation-compte">
            <div class="titre-info-perso">
                <img src="assets/images/creation-compte.png" alt="Création de compte employé">
            </div>
            <p class="validation-changement-info"></p>
            <div class="first-ligne-info">
                <div class="infos-perso">
                    <label for="nom-creation-admin">Nom</label>
                    <input type="text" class="input-profil-utilisateur" id="nom-creation-admin" name="nom-creation-admin" placeholder="" autocomplete="family-name" required>
                </div>
                <div class="infos-perso">
                    <label for="prénom-creation-admin">Prénom</label>
                    <input type="text" class="input-profil-utilisateur" id="prénom-creation-admin" name="prenom-creation-admin" placeholder="" autocomplete="given-name" required>
                </div>
            </div>
            <div class="second-ligne-info">
                <div class="infos-perso">
                    <label for="email-profil-admin">Email</label>
                    <input type="email" class="input-profil-utilisateur" id="email-profil-admin" name="email-profil-admin" placeholder="" autocomplete="email" required>
                </div>
                <div class="infos-perso">
                    <label for="telephone-profil-admin">Téléphone</label>
                    <input type="tel" class="input-profil-utilisateur" id="telephone-profil-admin" name="telephone-profil-admin" inputmode="numeric" pattern="[0-9]{10}" maxlength="10" placeholder="" autocomplete="tel" required>
                </div>
            </div>
            <div class="third-ligne-info">
                <label for="role-creation-admin">Rôle<span class="requis" aria-hidden="true">*</span></label>
                <select id="role-creation-admin" required>
                    <option value="">Sélectionnez un rôle</option>
                    <option value="employe">Employé</option>
                </select>
            </div>
            <div class="btn-profil-utilisateur-modif">
                <button type="button" class="animated-button" id="btn-creation-admin-valider">
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


        <!-- ADMIN VOIR COMMANDES EN COURS -->
        <div class="profil-admin-box-voir-commandes" id="profil-admin-box-voir-commandes">
            <div class="titre-info-perso">
                <img src="assets/images/commandes-en-attente-de-validation.png" alt="Commande en attente de validation">
            </div>

            <div class="profil-employe-commandes-liste">
                <div class="profil-employe-commandes-entete">
                    <span>Commande n°</span>
                    <span>Nom du menu</span>
                    <span>Nbr de personnes</span>
                    <span>Date préstation</span>
                    <span>Status</span>
                    <span>Commentaires</span>
                </div>
                <!-- AJOUTE commandes.js ICI -->
                <div class="profil-employe-commandes-ligne" role="row">
                    <div class="theme-checkbox">
                        <div class="theme-individual">
                            <label class="checkbox-custom">
                                <input type="checkbox" id="validation-employe">
                                <div class="checkbox-mark"></div>
                                <span class="commandes-champ" data-label="Status">En attente de validation</span>
                            </label>
                        </div>
                    </div>

                    <button type="button" class="animated-button" id="btn-admin-voir-detail-commande">
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

        <!-- ADMIN STATISTIQUES -->

<!--        <div class="profil-admin-box-voir-statistiques" id="profil-admin-box-voir-statistiques">-->
<!--            <div class="titre-info-perso">-->
<!--                <img src="assets/images/voir-stats.png" alt="Statistiques">-->
<!--            </div>-->
<!---->
<!--            <div class="admin-selecteur-stats">-->
<!--                <div class="first-ligne-periode">-->
<!--                    <label for="periode-stats-admin">Période :</label>-->
<!--                    <select id="periode-stats-admin" name="periode-stats-admin">-->
<!--                        <option value="">Sélectionnez un mois</option>-->
<!--                        <option value="janvier">Janvier</option>-->
<!--                        <option value="fevrier">Février</option>-->
<!--                        <option value="mars">Mars</option>-->
<!--                    </select>-->
<!--                </div>-->
<!--                <div class="second-ligne-status">-->
<!--                    <label for="status-stats-admin">Status :</label>-->
<!--                    <select id="status-stats-admin" name="status-stats-admin">-->
<!--                        <option value="">Sélectionnez un status</option>-->
<!--                        <option value="en attente">En attente</option>-->
<!--                        <option value="validee">Validée</option>-->
<!--                        <option value="annulee">Annulée</option>-->
<!--                    </select>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="admin-rapport-stats">-->
<!--                <div class="admin-rapport-ca">-->
<!--                    <label>CA du mois</label>-->
<!--                    <span data-label="ca du mois">1600 €</span>-->
<!--                </div>-->
<!--                <div class="admin-rapport-commandes-validees">-->
<!--                    <label>Commandes validées</label>-->
<!--                    <span data-label="commandes validées">26</span>-->
<!--                </div>-->
<!--                <div class="admin-rapport-note-moyenne">-->
<!--                    <label>Note moyenne</label>-->
<!--                    <span data-label="note moyenne">4.5 / 5</span>-->
<!--                </div>-->
<!--                <div class="admin-rapport-taux-annulation">-->
<!--                    <label>Taux d'annulation</label>-->
<!--                    <span data-label="taux d'annulation">5%</span>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div>-->
<!--                <div class="statistiques-titre">-->
<!--                    <span>Menus les plus commandés</span>-->
<!--                </div>-->
<!---->
<!--                <div class="profil-admin-statistiques-liste">-->
<!---->
<!--                    <span>Menus</span>-->
<!--                    <span>Commandes</span>-->
<!--                    <span>CA</span>-->
<!--                </div>-->
<!---->
<!--                    <div class="profil-admin-statistiques-ligne" role="row">-->
<!--                        <span class="commandes-champ" data-label="menu de noel">12</span>-->
<!--                        <span class="commandes-champ" data-label="menu de paques">30</span>-->
<!--                        <span class="commandes-champ" data-label="menu classique">24</span>-->
<!--                        <span class="commandes-champ" data-label="menu evenementiel">20</span>-->
<!--                        <span class="commandes-champ" data-label="menu vegetarien">12</span>-->
<!--                    </div>-->
<!---->
<!--                    <div class="profil-admin-statistiques-ligne" role="row">-->
<!--                        <span class="commandes-champ" data-label="menu de noel ca">500€</span>-->
<!--                        <span class="commandes-champ" data-label="menu de paques ca">500€</span>-->
<!--                        <span class="commandes-champ" data-label="menu classique ca">500€</span>-->
<!--                        <span class="commandes-champ" data-label="menu evenementiel ca">500€</span>-->
<!--                        <span class="commandes-champ" data-label="menu vegetarien ca">500€</span>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->










        </div>















    </div>
</main>

<?php require 'includes/footer.php'; ?>

