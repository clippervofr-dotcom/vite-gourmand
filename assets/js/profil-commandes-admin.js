

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
                    <span class="commandes-champ" data-label="Nom">${employe.nom}</span>
                    <span class="commandes-champ" data-label="Prénom">${employe.prenom}</span>
                    <span class="commandes-champ" data-label="Email">${employe.email}</span>
                    <span class="commandes-champ" data-label="Téléphone">${employe.telephone}</span>
                    <span class="commandes-champ" data-label="Rôle">${employe.libelle}</span>
                    <span class="commandes-champ" data-label="Commentaires">—</span>
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