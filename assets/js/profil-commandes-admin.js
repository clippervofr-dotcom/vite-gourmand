

const conteneurListeEmploye = document.querySelector('.profil-admin-commandes-liste');

if (conteneurListeEmploye) {

    async function chargerListeEmploye() {
        const reponse = await fetch('profil-admin-liste-employe.php');
        const listeEmploye = await reponse.json();

        afficherListeEmploye(listeEmploye);
    }

    function afficherListeEmploye(listeEmploye) {
        const conteneur = document.querySelector('.profil-admin-commandes-liste');

        conteneur.querySelectorAll('.profil-admin-commandes-ligne').forEach(function (ligne) {
            ligne.remove();
        });

        listeEmploye.forEach(function (employe) {
            const ligne = document.createElement('div');
            ligne.classList.add('profil-admin-commandes-ligne');
            ligne.innerHTML = `
                    <span class="commandes-champ" data-label="Nom">${echapperHTML(employe.nom)}</span>
                    <span class="commandes-champ" data-label="Prénom">${echapperHTML(employe.prenom)}</span>
                    <span class="commandes-champ" data-label="Email">${echapperHTML(employe.email)}</span>
                    <span class="commandes-champ" data-label="Téléphone">${echapperHTML(employe.telephone)}</span>
                    <span class="commandes-champ" data-label="Rôle">${echapperHTML(employe.libelle)}</span>
            `;
            conteneur.appendChild(ligne);
        });
    }

    function creationEmploye() {
        const nomCreation = document.querySelector('#nom-creation-admin');
        const prenomCreation = document.querySelector('#prenom-creation-admin');
        const emailCreation = document.querySelector('#email-creation-admin');
        const telephoneCreation = document.querySelector('#telephone-creation-admin');
        const adresseCreation = document.querySelector('#adresse-creation-admin');
        const codePostalCreation = document.querySelector('#code-postal-creation-admin');
        const villeCreation = document.querySelector('#ville-creation-admin');

        const radioChecked = document.querySelector('input[name="role-creation-admin"]:checked');
        const roleCreation = radioChecked ? radioChecked.value : null;

        const donnees = new FormData();
        donnees.append('nom', nomCreation.value);
        donnees.append('prenom', prenomCreation.value);
        donnees.append('email', emailCreation.value);
        donnees.append('telephone', telephoneCreation.value);
        donnees.append('adresse', adresseCreation.value);
        donnees.append('code_postal', codePostalCreation.value);
        donnees.append('ville', villeCreation.value);
        donnees.append('role', roleCreation);

        const reponse = fetch('profil-admin-creation-employe.php', {
            method: 'POST',
            body: donnees
        })
        const nouvelleListeEmploye = reponse.json();

        if (!nouvelleListeEmploye['success']) {
            console.error(nouvelleListeEmploye['message']);
        }

        chargerListeEmploye().catch(function (erreur) {
            console.error('Erreur lors du chargement des nouveaux employés :', erreur);
        });
    }

    const btnValiderCreation = document.querySelector('#btn-creation-employe-valider');

    btnValiderCreation.addEventListener('click', function (event) {
        creationEmploye();
    });

    chargerListeEmploye().catch(function (erreur) {
        console.error('Erreur lors du chargement des nouveaux employés :', erreur);
    });
}

const conteneurModifHoraires = document.querySelector('.profil-admin-box-modif-horaire');

if (conteneurModifHoraires) {

    async function chargerHoraires() {
        const reponse = await fetch('horaires-chargement.php');
        const horairesChargement = await reponse.json();

        afficherHoraires(horairesChargement);
    }

    function afficherHoraires(horairesChargement) {

        document.querySelector('#modif-ouverture-lundi').value = horairesChargement['0']['heure_ouverture'];
        document.querySelector('#modif-fermeture-lundi').value = horairesChargement['0']['heure_fermeture'];
        document.querySelector('#modif-ouverture-mardi').value = horairesChargement['1']['heure_ouverture'];
        document.querySelector('#modif-fermeture-mardi').value = horairesChargement['1']['heure_fermeture'];
        document.querySelector('#modif-ouverture-mercredi').value = horairesChargement['2']['heure_ouverture'];
        document.querySelector('#modif-fermeture-mercredi').value = horairesChargement['2']['heure_fermeture'];
        document.querySelector('#modif-ouverture-jeudi').value = horairesChargement['3']['heure_ouverture'];
        document.querySelector('#modif-fermeture-jeudi').value = horairesChargement['3']['heure_fermeture'];
        document.querySelector('#modif-ouverture-vendredi').value = horairesChargement['4']['heure_ouverture'];
        document.querySelector('#modif-fermeture-vendredi').value = horairesChargement['4']['heure_fermeture'];
        document.querySelector('#modif-ouverture-samedi').value = horairesChargement['5']['heure_ouverture'];
        document.querySelector('#modif-fermeture-samedi').value = horairesChargement['5']['heure_fermeture'];
    }
    chargerHoraires().catch(function (erreur) {
        console.error('Erreur lors du chargement des modifications horaires :', erreur);
    });

    const btnValiderHoraires = document.querySelector('#btn-modif-horaire-valider');
    const validationChange = document.querySelector('.validation-change-horaire');

    btnValiderHoraires.addEventListener('click', function () {
        async function nouveauxHoraires() {

            const inputLundiOuverture = document.querySelector('#modif-ouverture-lundi');
            const inputLundiFermeture = document.querySelector('#modif-fermeture-lundi');
            const inputMardiOuverture = document.querySelector('#modif-ouverture-mardi');
            const inputMardiFermeture = document.querySelector('#modif-fermeture-mardi');
            const inputMercrediOuverture = document.querySelector('#modif-ouverture-mercredi');
            const inputMercrediFermeture = document.querySelector('#modif-fermeture-mercredi');
            const inputJeudiOuverture = document.querySelector('#modif-ouverture-jeudi');
            const inputJeudiFermeture = document.querySelector('#modif-fermeture-jeudi');
            const inputVendrediOuverture = document.querySelector('#modif-ouverture-vendredi');
            const inputVendrediFermeture = document.querySelector('#modif-fermeture-vendredi');
            const inputSamediOuverture = document.querySelector('#modif-ouverture-samedi');
            const inputSamediFermeture = document.querySelector('#modif-fermeture-samedi');

            const donnees = new FormData();

            donnees.append('lundi-ouverture', inputLundiOuverture.value);
            donnees.append('lundi-fermeture', inputLundiFermeture.value);
            donnees.append('mardi-ouverture', inputMardiOuverture.value);
            donnees.append('mardi-fermeture', inputMardiFermeture.value);
            donnees.append('mercredi-ouverture', inputMercrediOuverture.value);
            donnees.append('mercredi-fermeture', inputMercrediFermeture.value);
            donnees.append('jeudi-ouverture', inputJeudiOuverture.value);
            donnees.append('jeudi-fermeture', inputJeudiFermeture.value);
            donnees.append('vendredi-ouverture', inputVendrediOuverture.value);
            donnees.append('vendredi-fermeture', inputVendrediFermeture.value);
            donnees.append('samedi-ouverture', inputSamediOuverture.value);
            donnees.append('samedi-fermeture', inputSamediFermeture.value);

            await fetch('', {
                method: 'POST',
                body: donnees
            });
            validationChange.textContent = "Changements enregistrés !";
            setTimeout(function () {
                validationChange.textContent = "";
            }, 3000);
        }
        nouveauxHoraires().catch(function (erreur) {
            console.error('Erreur lors du fetch des nouveaux horaires :', erreur);
        });

        chargerHoraires().catch(function (erreur) {
            console.error('Erreur lors du chargement des nouveaux horaires :', erreur);
        });
    });
}