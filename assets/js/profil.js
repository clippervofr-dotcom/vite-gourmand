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

const btnAdminListeEmploye = document.querySelector('#btn-compte-employe-admin'); // BTN onglet liste employés
const btnAdminVoirCommandes = document.querySelector('#btn-voir-commandes-admin'); // BTN onglet voir les commandes en cours
const btnAdminStatistiques = document.querySelector('#btn-voir-statistiques-admin'); // BTN onglet statistiques

const profilAdminListeEmploye = document.querySelector('#profil-admin-box-liste-employe'); // page liste employés
const profilAdminCreationEmploye = document.querySelector('#profil-admin-box-creation-compte'); // page creation employés

// manque fetch() page des commandes en cours de profile-employe.php

const profilAdminStatistiques = document.querySelector('#profil-admin-box-statistiques'); //page statistiques

if (btnAdminVoirCommandes && btnAdminStatistiques && btnAdminListeEmploye && profilAdminListeEmploye && profilAdminCreationEmploye && profilAdminStatistiques) {

    btnAdminListeEmploye.addEventListener('click', function () {
        profilAdminListeEmploye.classList.add('active');
        profilAdminStatistiques.classList.remove('active');
        profilAdminCreationEmploye.classList.remove('active');
        // fermera profilAdminVoirCommandes après fetch()
    });

    btnAdminStatistiques.addEventListener('click', function () {
        profilAdminCreationEmploye.classList.remove('active');
        profilAdminStatistiques.classList.add('active');
        profilAdminListeEmploye.classList.remove('active');
        // fermera profilAdminVoirCommandes après fetch()
    });
}

const btnAdminCreationEmploye = document.querySelector('#btn-creation-compte-employe'); // BTN onglet création employés
const btnAdminCreationValidation = document.querySelector('#btn-creation-admin-valider'); // BTN validation création employés

if (btnAdminCreationEmploye) {
    btnAdminCreationEmploye.addEventListener('click', function () {
        profilAdminCreationEmploye.classList.add('active');
        profilAdminStatistiques.classList.remove('active');
        profilAdminListeEmploye.classList.remove('active');
        // fermera profilAdminVoirCommandes après fetch()
    });
}

if (btnAdminCreationValidation) {
    btnAdminCreationValidation.addEventListener('click', function () {
        profilAdminListeEmploye.classList.add('active');
        profilAdminCreationEmploye.classList.remove('active');
        validationChange.textContent = "Nouvel employé ajouté !";
        setTimeout(function () {
            validationChange.textContent = "";
        }, 3000);
    });
}
