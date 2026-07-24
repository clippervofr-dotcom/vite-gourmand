/* PROFIL UTILISATEUR */
/* Disabled = false / true des inputs pour modif + validation */
const validationChange = document.querySelector('.validation-changement-info');
const btnUtilisateurModif = document.querySelector('#btn-profil-utilisateur-modif');
const btnUtilisateurValider = document.querySelector('#btn-profil-utilisateur-valider');

if (btnUtilisateurValider && btnUtilisateurModif) {

    function disabledTrigger() {
        let inputs = document.getElementsByClassName('input-profil-utilisateur');
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].disabled = false;
        }
    }

    btnUtilisateurModif.addEventListener('click', function () {
        disabledTrigger();
    });

    btnUtilisateurValider.addEventListener('click', function () {
        let inputs = document.getElementsByClassName('input-profil-utilisateur');
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].disabled = true;
            validationChange.textContent = "Changements enregistrés !";
            setTimeout(function () {
                validationChange.textContent = "";
            }, 3000);
        }
    });
}
//nav profil utilisateur
const btnUtilisateurInfo = document.querySelector("#btn-info-perso-utilisateur");
const profilUtilisateurInfo = document.querySelector("#profil-utilisateur-box-info-perso");
const btnUtilisateurCommandes = document.querySelector("#btn-profil-commandes-utilisateur");
const profilUtilisateurCommandes = document.querySelector("#profil-utilisateur-box-commandes");

if (btnUtilisateurInfo && profilUtilisateurInfo && profilUtilisateurCommandes && btnUtilisateurCommandes) {

    btnUtilisateurInfo.addEventListener('click', function () {
        profilUtilisateurInfo.classList.add('active');
        profilUtilisateurCommandes.classList.remove('active');
    });

    btnUtilisateurCommandes.addEventListener('click', function () {
        profilUtilisateurCommandes.classList.add('active');
        profilUtilisateurInfo.classList.remove('active');
    });
}

//nav profil admin
//btn nav
const btnAdminListeEmploye = document.querySelector("#btn-nav-admin-liste-employe");
const btnAdminVoirCommandes = document.querySelector("#btn-nav-admin-voir-commandes");
const btnAdminVoirStatistiques = document.querySelector("#btn-nav-admin-voir-statistiques");

//btn creation compte + validation
const btnAdminCreationCompte = document.querySelector("#btn-creation-compte-employe");
const btnAdminValidationCreation = document.querySelector("#btn-creation-admin-valider");

//sections
//liste employe
const adminListeEmploye = document.querySelector("#profil-admin-box-liste-employe");
//creation compte
const adminCreationCompte = document.querySelector("#profil-admin-box-creation-compte");
//voir commandes
const adminVoirCommandes = document.querySelector("#profil-admin-box-voir-commandes");

//voir details commandes
const btnAdminVoirDetailCommande = document.querySelector("#btn-admin-voir-detail-commande");

//voir statistiques
//#btn-admin-voir-statistiques
//#profil-admin-box-voir-statistiques

if (adminVoirCommandes && btnAdminVoirDetailCommande && btnAdminListeEmploye && btnAdminVoirCommandes && btnAdminVoirStatistiques && adminListeEmploye && adminCreationCompte && btnAdminCreationCompte && btnAdminValidationCreation) {

    btnAdminListeEmploye.addEventListener('click', function () {
        adminListeEmploye.classList.add('active');
        adminCreationCompte.classList.remove('active');
        adminVoirCommandes.classList.remove('active');
    });

    btnAdminCreationCompte.addEventListener('click', function () {
        adminCreationCompte.classList.add('active');
        adminListeEmploye.classList.remove('active');
        adminVoirCommandes.classList.remove('active');
    });

    btnAdminVoirCommandes.addEventListener('click', function () {
        adminVoirCommandes.classList.add('active');
        adminListeEmploye.classList.remove('active');
        adminCreationCompte.classList.remove('active');
    });




    btnAdminValidationCreation.addEventListener('click', function () {
        adminListeEmploye.classList.add('active');
        adminCreationCompte.classList.remove('active');
        validationChange.textContent = "Nouveau compte employé créé avec succès !";
        setTimeout(function () {
            validationChange.textContent = "";
        }, 3000);
    });



}
