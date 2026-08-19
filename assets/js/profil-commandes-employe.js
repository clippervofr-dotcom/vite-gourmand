// gestion et affichages commandes en attente de validation + en attente/validée
const conteneurCommandes = document.querySelector('.profil-employe-commandes-liste');

const bdyHeader = document.querySelector('.body-header');
const role = parseInt(bdyHeader.dataset.roleId);

async function chargerCommandesEnAttente(statut) {
    const reponse = await fetch('commandes-en-attente.php?statut=' + encodeURIComponent(statut));
    const commandesEnAttente = await reponse.json();

    afficherCommandes(commandesEnAttente);
}

function afficherCommandes(commandesEnAttente) {
    const conteneur = document.querySelector('.profil-employe-commandes-liste');
    conteneur.querySelectorAll('.profil-employe-commandes-ligne').forEach(function (ligne) {
        ligne.remove();
    });

    if (commandesEnAttente.length === 0) {
        const messageAucun = document.createElement('div');
        messageAucun.classList.add('profil-employe-commandes-ligne');
        messageAucun.innerHTML = `<span class="commandes-champ" data-label="Aucune commande">Aucune commande à afficher.</span>`;
        conteneur.appendChild(messageAucun);
        return;
    }


    commandesEnAttente.forEach(function (commande) {
        const ligne = document.createElement('div');
        ligne.classList.add('profil-employe-commandes-ligne');
        ligne.dataset.commandeId = commande['commande_id'];
        ligne.innerHTML = `
                <span class="commandes-champ" data-label="Commande n°">${commande['numero_commande']}</span>
                <span class="commandes-champ" data-label="Nom du menu">${commande['titre']}</span>
                <span class="commandes-champ" data-label="Nbr de personnes">${echapperHTML(commande['nombre_personnes'])}</span>
                <span class="commandes-champ" data-label="Date prestation">${echapperHTML(commande['date_prestation'])}</span>
                <span class="commandes-champ" data-label="Status">${commande['statut']}</span>
                <span class="commandes-champ" data-label="Commentaires">${echapperHTML(commande['motif_annulation'] ?? '-')}</span>
                <button type="button" class="btn-voir-detail-commande" id="btn-voir-detail-commande">
                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                    <span class="text" data-commande-id="${commande['commande_id']}">Détails</span>
                    <span class="circle"></span>
                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                </button>
                ${commande['statut'] === 'en attente' ?
            `<button type="button" class="btn-validation-commande" data-statut="validée" id="btn-validation-commande">
                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                    <span class="text" data-commande-id="${commande['commande_id']}">Valider</span>
                    <span class="circle"></span>
                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                </button>`
            : ''}
                ${role === 3 && commande['statut'] === 'en attente' ?
            `<button type="button" class="btn-annulation-commande-admin" data-statut="annulée" id="btn-annulation-commande-admin">
                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                    <span class="text" data-commande-id="${commande['commande_id']}">Annuler</span>
                    <span class="circle"></span>
                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                </button>`
            : ''}
            `;
        conteneur.appendChild(ligne);
    });
}

if (conteneurCommandes) {


    conteneurCommandes.addEventListener('click', async function (event) {
        const boutonValider = event.target.closest('.btn-validation-commande');
        if (!boutonValider) return;

        const ligne = boutonValider.closest('.profil-employe-commandes-ligne');
        const commandeId = ligne.dataset.commandeId;

        const donnees = new FormData();
        donnees.append('commande_id', commandeId);
        donnees.append('statut', 'validée');
        donnees.append('csrf_token', getCsrfToken());

        const reponse = await fetch('commandes-employe-valider.php', {
            method: 'POST',
            body: donnees
        });
        const resultat = await reponse.json();

        if (resultat['success']) {
            const statutActif = document.querySelector('.btn-statut-commande.active');
            chargerCommandesEnAttente(statutActif.dataset.statut);
        } else {
            console.error(resultat['message']);
        }
    });

    conteneurCommandes.addEventListener('click', async function (event) {
        const boutonAnnuler = event.target.closest('.btn-annulation-commande-admin');
        if (!boutonAnnuler) return;

        const ligne = boutonAnnuler.closest('.profil-employe-commandes-ligne');
        const commandeId = ligne.dataset.commandeId;

        const donnees = new FormData();
        donnees.append('commande_id', commandeId);
        donnees.append('csrf_token', getCsrfToken());

        const reponse = await fetch('profil-voir-details-commandes.php', {
            method: 'POST',
            body: donnees
        });
        const resultat = await reponse.json();

        if (!resultat['success']) {
            console.error(resultat['message']);
        }
        ouvrirModalAnnulationAdmin(resultat);
    });

    conteneurCommandes.addEventListener('click', async function (event) {
        const btnVoirDetail = event.target.closest('.btn-voir-detail-commande');
        if (!btnVoirDetail) return;

        const ligne = btnVoirDetail.closest('.profil-employe-commandes-ligne');
        const commandeId = ligne.dataset.commandeId;

        const donnees = new FormData();
        donnees.append('commande_id', commandeId);
        donnees.append('csrf_token', getCsrfToken());

        const reponse = await fetch('profil-voir-details-commandes.php', {
            method: 'POST',
            body: donnees
        });
        const resultat = await reponse.json();

        if (!resultat['success']) {
            console.error(resultat['message']);
        }

        ouvrirModalDetail(resultat);
    });

    const btnStatut = document.querySelectorAll('.btn-statut-commande');

    btnStatut.forEach(function (bouton) {
        bouton.addEventListener('click', function () {
            btnStatut.forEach(function (btn) {
                btn.classList.remove('active');
            });
            bouton.classList.add('active');

            const statutChoisi = bouton.dataset.statut;
            chargerCommandesEnAttente(statutChoisi).catch(function (erreur) {
                console.error('Erreur lors du changement du statut :', erreur);
            });
        });
    });
    chargerCommandesEnAttente().catch(function (erreur) {
        console.error('Erreur lors du chargement des commandes en attente :', erreur);
    });
}

// Commande Detail modale

const detailCommandeModal = document.querySelector('#commande-detail-modal');
const detailCommandeModalClose = document.querySelector('#commande-detail-close');

if (detailCommandeModalClose && detailCommandeModal) {

    function ouvrirModalDetail (resultat) {

        const commande = resultat['commande'];

        //date commande
        const dateReplace = commande['date_commande'].replace(' ', 'T');
        const newDate = new Date(dateReplace);
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const dateString = newDate.toLocaleDateString('fr-FR', options);

        //date prestation
        const datePrestation = new Date(commande['date_prestation']);
        const datePrestationString = datePrestation.toLocaleDateString('fr-FR', options);

        //heure prestation
        const heurePrestationBrut = commande['heure_prestation'];
        const heurePrestation = heurePrestationBrut.replace(':', 'h');

        document.querySelector('#commande-detail-numero-commande').textContent = commande['numero_commande'];
        document.querySelector('#commande-detail-titre-commande').textContent = commande['titre'];
        document.querySelector('#commande-detail-date-commande').textContent = capitalizeFirstLetter(dateString);
        document.querySelector('#commande-detail-date-prestation').textContent = capitalizeFirstLetter(datePrestationString);
        document.querySelector('#commande-detail-heure-prestation').textContent = heurePrestation;
        document.querySelector('#commande-detail-adresse-livraison').textContent = commande['adresse_livraison'];
        document.querySelector('#commande-detail-pret-materiel').textContent = `${commande['pret_materiel'] ? 'Matériel prêté' : 'Aucun matériel prêté'}`;
        document.querySelector('#commande-detail-prix-total').textContent = `${commande['prix_total'] ?? '-'} €`;
        document.querySelector('#commande-detail-nom-client').textContent = commande['utilisateur_nom'];
        document.querySelector('#commande-detail-prenom-client').textContent = commande['utilisateur_prenom'];
        document.querySelector('#commande-detail-email-client').textContent = commande['utilisateur_email'];
        document.querySelector('#commande-detail-tel-client').textContent = commande['utilisateur_telephone'];

        detailCommandeModal.classList.add('active');
    }

    detailCommandeModalClose.addEventListener('click', function () {
        detailCommandeModal.classList.remove('active');
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            detailCommandeModal.classList.remove('active');
        }
    });

    detailCommandeModal.addEventListener('click', function (event) {
        if (event.target === detailCommandeModal) {
            detailCommandeModal.classList.remove('active');
        }
    });
}

// annulation commande admin Modal

const annulationModalAdmin = document.querySelector('#annulation-modal-admin');
const annulationModalAdminClose = document.querySelector('#annulation-modal-admin-close');

if (annulationModalAdmin && annulationModalAdminClose) {

    function ouvrirModalAnnulationAdmin(resultat) {

        const commande = resultat['commande'];
        annulationModalAdmin.dataset.commandeId = commande['commande_id'];

        //date prestation
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const datePrestation = new Date(commande['date_prestation']);
        const datePrestationString = datePrestation.toLocaleDateString('fr-FR', options);

        document.querySelector('#annulation-numero-admin').textContent = commande['numero_commande'];
        document.querySelector('#annulation-date-prestation-admin').textContent = capitalizeFirstLetter(datePrestationString);
        document.querySelector('#annulation-reglement-admin').textContent = `${commande['prix_total'] ?? '-'} €`;

        annulationModalAdmin.classList.add('active');
    }
    annulationModalAdminClose.addEventListener('click', function () {
        annulationModalAdmin.classList.remove('active');
    });

    annulationModalAdmin.addEventListener('click', async function (event) {
        const boutonAnnulerCommande = event.target.closest('.btn-annulation-admin-confirmer');
        if (!boutonAnnulerCommande) return;

        const commandeId = annulationModalAdmin.dataset.commandeId;

        const radioChecked = document.querySelector('input[name="annulation-choice"]:checked');
        const annulationType = radioChecked ? radioChecked.value : null;

        const motifAnnulation = document.querySelector('#annulation-content-textarea');

        const donnees = new FormData();
        donnees.append('commande_id', commandeId);
        donnees.append('statut', 'annulée');
        donnees.append('annulation_type', annulationType);
        donnees.append('motif_annulation', motifAnnulation.value);
        donnees.append('csrf_token', getCsrfToken());

        const reponse = await fetch('commandes-admin-annuler.php', {
            method: 'POST',
            body: donnees
        });
        const resultat = await reponse.json();

        if (resultat['success']) {
            const statutActif = document.querySelector('.btn-statut-commande.active');
            annulationModalAdmin.classList.remove('active');
            await chargerCommandesEnAttente(statutActif.dataset.statut);
        } else {
            console.error(resultat['message']);
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            annulationModalAdmin.classList.remove('active');
        }
    });

    annulationModalAdmin.addEventListener('click', function (event) {
        if (event.target === annulationModalAdmin) {
            annulationModalAdmin.classList.remove('active');
        }
    });
}





