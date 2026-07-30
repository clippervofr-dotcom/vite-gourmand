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
        async function nouvelleInfosUtilisateur() {
            const inputNomUtilisateur = document.querySelector('#nom-profil-utilisateur');
            const inputPrenomUtilisateur = document.querySelector('#prenom-profil-utilisateur');
            const inputEmailUtilisateur = document.querySelector('#email-profil-utilisateur');
            const inputTelephoneUtilisateur = document.querySelector('#telephone-profil-utilisateur');
            const inputAdresseUtilisateur = document.querySelector('#adresse-profil-utilisateur');
            const inputVilleUtilisateur = document.querySelector('#ville-profil-utilisateur');
            const inputCodePostalUtilisateur = document.querySelector('#code-postal-profil-utilisateur');

            const donnees = new FormData();

            donnees.append('nom', inputNomUtilisateur.value);
            donnees.append('prenom', inputPrenomUtilisateur.value);
            donnees.append('email', inputEmailUtilisateur.value);
            donnees.append('telephone', inputTelephoneUtilisateur.value);
            donnees.append('adresse', inputAdresseUtilisateur.value);
            donnees.append('ville', inputVilleUtilisateur.value);
            donnees.append('code_postal', inputCodePostalUtilisateur.value);

            await fetch ('profile-update.php', {
                method: 'POST',
                body: donnees
            });
        }
        let inputs = document.getElementsByClassName('input-profil-utilisateur');
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].disabled = true;
            validationChange.textContent = "Changements enregistrés !";
            setTimeout(function () {
                validationChange.textContent = "";
            }, 3000);
        }
        nouvelleInfosUtilisateur().catch(function (erreur) {
            console.error('Erreur lors de fetch des nouvelles informations du profil :', erreur);
        });

        chargerInfo().catch(function (erreur) {
            console.error('Erreur lors du chargement des informations du profil :', erreur);
        });
    });
}
//nav profil utilisateur
const btnUtilisateurInfo = document.querySelector("#btn-info-perso-utilisateur");
const profilUtilisateurInfo = document.querySelector("#profil-utilisateur-box-info-perso");
const btnUtilisateurCommandes = document.querySelector("#btn-profil-commandes-utilisateur");
const profilUtilisateurCommandes = document.querySelector("#profil-utilisateur-box-commandes");

if (btnUtilisateurInfo && profilUtilisateurInfo && profilUtilisateurCommandes && btnUtilisateurCommandes) {

    async function chargerInfo() {
        const reponse = await fetch('profile.php');
        const infos = await reponse.json();

        if (!infos['success']) {
            console.error(infos['message']);
        }

        document.querySelector('#nom-profil-utilisateur').value = infos['nom'] ?? null;
        document.querySelector('#prenom-profil-utilisateur').value = infos['prenom'] ?? null;
        document.querySelector('#email-profil-utilisateur').value = infos['email'] ?? null;
        document.querySelector('#telephone-profil-utilisateur').value = infos['telephone'] ?? null;
        document.querySelector('#adresse-profil-utilisateur').value = infos['adresse'] ?? null;
        document.querySelector('#ville-profil-utilisateur').value = infos['ville'] ?? null;
        document.querySelector('#code-postal-profil-utilisateur').value = infos['code_postal'] ?? null;
    }
    btnUtilisateurInfo.addEventListener('click', function () {
        profilUtilisateurInfo.classList.add('active');
        profilUtilisateurCommandes.classList.remove('active');
    });

    btnUtilisateurCommandes.addEventListener('click', function () {
        profilUtilisateurCommandes.classList.add('active');
        profilUtilisateurInfo.classList.remove('active');
    });
    chargerInfo().catch(function (erreur) {
        console.error('Erreur lors du chargement des informations du profil :', erreur);
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
