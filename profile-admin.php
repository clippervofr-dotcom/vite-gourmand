<?php $css_pages = ['profil']; ?>
<?php require 'includes/header.php'; ?>

<?php
$heure = (int) date('H');
$salutation = $heure < 12 ? 'Bonjour' : ($heure < 18 ? 'Bon après-midi' : 'Bonsoir');
?>

<main>
    <div class="titre-profil-utilisateur" id="titre-profil-utilisateur">
        <h1>Bienvenue dans ton profil $admin !</h1>
        <!--        <h1><?= $salutation ?>, <?= htmlspecialchars($_SESSION['utilisateur']['prenom']) ?> !</h1>-->
    </div>

    <div class="nav-profil-utilisateur" id="nav-profil-utilisateur">
        <button type="button" class="animated-button" id="btn-compte-employe-admin">
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
        <button type="button" class="animated-button" id="btn-voir-commandes-admin">
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
        <button type="button" class="animated-button" id="btn-voir-statistiques-admin">
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

    <div class="profil-box-fond">
        <div class="fond-exterieur" id="fond-exterieur-admin"></div>


<!--        <div class="profil-admin-box-liste-employe active" id="profil-utilisateur-box-commandes">-->
<!--            <div class="titre-info-perso">-->
<!--                <img src="assets/images/compte-employe.png" alt="compte employé">-->
<!--            </div>-->
<!--            <p class="validation-changement-info"></p>-->
<!---->
<!--            <div class="profil-admin-commandes-liste">-->
<!--                <div class="profil-admin-commandes-entete">-->
<!--                    <span>Employé n°</span>-->
<!--                    <span>Nom</span>-->
<!--                    <span>Prénom</span>-->
<!--                    <span>Email</span>-->
<!--                    <span>Téléphone</span>-->
<!--                    <span>Rôle</span>-->
<!--                    <span>Status</span>-->
<!--                    <span>Commentaires</span>-->
<!--                </div>-->
<!---->
<!--                <div class="profil-admin-commandes-ligne" role="row">-->
<!--                    <span class="commandes-champ" data-label="Employé n°">01</span>-->
<!--                    <span class="commandes-champ" data-label="Nom">Dupont</span>-->
<!--                    <span class="commandes-champ" data-label="Prénom">Jean</span>-->
<!--                    <span class="commandes-champ" data-label="Email">jean.dupont@example.com</span>-->
<!--                    <span class="commandes-champ" data-label="Téléphone">01 23 45 67 89</span>-->
<!--                    <span class="commandes-champ" data-label="Rôle">Employé</span>-->
<!--                    <span class="commandes-champ" data-label="Status">Actif</span>-->
<!--                    <span class="commandes-champ" data-label="Commentaires">—</span>-->
<!--                </div>-->
<!--            </div>-->
<!--            <button type="button" class="animated-button" id="btn-creation-compte-employe">-->
<!--                <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">-->
<!--                    <path-->
<!--                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"-->
<!--                    ></path>-->
<!--                </svg>-->
<!--                <span class="text">Créer un compte employé</span>-->
<!--                <span class="circle"></span>-->
<!--                <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">-->
<!--                    <path-->
<!--                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"-->
<!--                    ></path>-->
<!--                </svg>-->
<!--            </button>-->
<!--        </div>-->


        <div class="profil-admin-box-creation-compte active" id="profil-utilisateur-box-info-perso">
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

















    </div>
</main>

<?php require 'includes/footer.php'; ?>

