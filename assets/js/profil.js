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



