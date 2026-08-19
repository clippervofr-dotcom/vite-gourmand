//UTILISATEUR -- Affichage des commandes
const conteneurCommandesUser = document.querySelector('.profil-utilisateur-commandes-liste');
let derniereCommandesRecues = [];
let ordreCroissant = true;

async function chargerCommandesUser() {
    const reponse = await fetch('mes-commandes.php');
    const commandesUser = await reponse.json();

    derniereCommandesRecues = commandesUser;
    afficherCommandesUser(commandesUser);
}

if (conteneurCommandesUser) {
    function afficherCommandesUser(commandesUser) {
        const conteneurUser = document.querySelector('.profil-utilisateur-commandes-liste');
        conteneurUser.querySelectorAll('.profil-utilisateur-commandes-ligne').forEach(function (ligne) {
            ligne.remove();
        });

        if (commandesUser.length === 0) {
            const messageAucun = document.createElement('div');
            messageAucun.classList.add('profil-utilisateur-commandes-ligne');
            messageAucun.innerHTML = `<span class="commandes-champ" data-label="Aucune commande">Aucune commande à afficher.</span>`;
            conteneurUser.appendChild(messageAucun);
            return;
        }


        commandesUser.forEach(function (commande) {
            const ligne = document.createElement('div');
            ligne.classList.add('profil-utilisateur-commandes-ligne');
            ligne.dataset.commandeId = commande['commande_id'];
            ligne.innerHTML = `
                <span class="commandes-champ" data-label="Commande n°">${commande['numero_commande']}</span>
                <span class="commandes-champ" data-label="Nom du menu">${commande['titre']}</span>
                <span class="commandes-champ" data-label="Nbr de personnes">${echapperHTML(commande['nombre_personnes'])}</span>
                <span class="commandes-champ" data-label="Date prestation">${echapperHTML(commande['date_prestation'])}</span>
                <span class="commandes-champ" data-label="Status">${echapperHTML(commande['statut'])}</span>
                <span class="commandes-champ" data-label="Commentaires">${echapperHTML(commande['motif_annulation']) ?? '-'}</span>   
                ${commande['statut'] !== 'annulée' && commande['statut'] !== 'terminée' ? `
                <button type="button" class="btn-annulation-commande">
                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                    <span class="text">Annuler</span>
                    <span class="circle"></span>
                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                </button>
                ` : ''}
                ${commande['statut'] === 'terminée' && commande['possede_avis'] === 0 ? `
                <button type="button" class="btn-commentaire-commande">
                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                    <span class="text">Laissez un avis</span>
                    <span class="circle"></span>
                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                </button>
                ` : ''}
                ${commande['possede_avis'] === 1 ? `
                <span class="text">Votre avis à bien été pris en compte.</span>
                ` : ''}
                    `;
            conteneurUser.appendChild(ligne);
        });
    }

    function trier(cle) {
        derniereCommandesRecues.sort((a, b) => {
            let resultat;

            if (cle === 'date_prestation') {
                const dateA = new Date(a[cle]);
                const dateB = new Date(b[cle]);
                resultat = dateA - dateB;
            } else if (typeof a[cle] === "string") {
                resultat = a[cle].localeCompare(b[cle]);
            } else {
                resultat = a[cle] - b[cle];
            }
            return ordreCroissant ? resultat : -resultat;
        });
        afficherCommandesUser(derniereCommandesRecues);
    }

    const colonnesTriables = [
        { bouton: '.user-commande-numero', fleche: '.fleche-tri-numero', cle: 'numero_commande' },
        { bouton: '.user-nom-menu', fleche: '.fleche-tri-titre', cle: 'titre' },
        { bouton: '.user-nbr-personnes', fleche: '.fleche-tri-nbr', cle: 'nombre_personnes' },
        { bouton: '.user-statut', fleche: '.fleche-tri-statut', cle: 'statut' },
        { bouton: '.user-date-prestation', fleche: '.fleche-tri-date', cle: 'date_prestation' }
    ];

    colonnesTriables.forEach(function (colonne) {
        document.querySelector(colonne.bouton).addEventListener('click', function () {
            ordreCroissant = !ordreCroissant;

            document.querySelectorAll('.fleche').forEach(function(fleche) {
                fleche.textContent = '';
            });
            document.querySelector(colonne.fleche).textContent = ordreCroissant ? '▲' : '▼';

            trier(colonne.cle);
        });
    });

    conteneurCommandesUser.addEventListener('click', function (event) {
        const boutonAnnuler = event.target.closest('.btn-annulation-commande');
        if (!boutonAnnuler) return;

        const ligne = boutonAnnuler.closest('.profil-utilisateur-commandes-ligne');
        const commandeId = ligne.dataset.commandeId;

        const commande = derniereCommandesRecues.find(function (c) {
            return c['commande_id'] == commandeId;
        });

        ouvrirAnnulationModal(commande);
    });

    conteneurCommandesUser.addEventListener('click', function (event) {
        const boutonAvis = event.target.closest('.btn-commentaire-commande');
        if (!boutonAvis) return;

        const ligne = boutonAvis.closest('.profil-utilisateur-commandes-ligne');
        const commandeId = ligne.dataset.commandeId;

        const commande = derniereCommandesRecues.find(function (c) {
            return c['commande_id'] == commandeId;
        });

        ouvrirAvisModal(commande);
    });

    chargerCommandesUser().catch(function (erreur) {
        console.error('Erreur lors du chargement des commandes :', erreur);
    });
}

//-- Annulation commande
const annulationModal = document.querySelector('#annulation-modal');
const annulationClose = document.querySelector('#annulation-modal-close');
const annulationCheckbox = document.querySelector('#annulation-checkbox');
const annulationConfirm = document.querySelector('#btn-annulation-confirmer');

if (annulationModal && annulationCheckbox && annulationConfirm && annulationClose) {

    function calculerTranche(datePrestation) {
        const dateEvenement = new Date(datePrestation);
        const maintenant = new Date();
        const joursRestants = (dateEvenement - maintenant) / (1000 * 60 * 60 * 24);

        if (joursRestants > 15) {
            return { texte: "Plus de 15 jours avant la prestation :\n remboursement intégral de l'acompte.", pourcentage: 1 };
        } else if (joursRestants > 2) {
            return { texte: "Entre 15 jours et 48h avant la prestation :\n l'acompte reste acquis à Vite & Gourmand, non remboursé.", pourcentage: 0 };
        } else {
            return { texte: "Moins de 48h avant la prestation :\n la totalité du montant reste due.", pourcentage: -1 };
        }
    }

    function ouvrirAnnulationModal(commande) {
        const tranche = calculerTranche(commande['date_prestation']);

        annulationModal.dataset.commandeId = commande['commande_id'];
        document.querySelector('#annulation-numero').textContent = `Commande :\n ${commande['numero_commande']}`
        ;
        document.querySelector('#annulation-date-prestation').textContent =
            `Date de prestation :\n ${commande['date_prestation']}`
        ;
        document.querySelector('#annulation-reglement').textContent = tranche.texte;

        annulationCheckbox.checked = false;
        annulationConfirm.disabled = true;

        annulationModal.classList.add('active');
    }

    function changementStatutAnnuler() {
        const commandeId = annulationModal.dataset.commandeId;

        const donnees = new FormData();
        donnees.append('commande_id', commandeId);
        donnees.append('statut', 'annulée');
        donnees.append('csrf_token', getCsrfToken());

        return fetch('commandes-utilisateur-annuler.php', {
            method: 'POST',
            body: donnees
        });
    }

    annulationCheckbox.addEventListener('change', function () {
        annulationConfirm.disabled = !annulationCheckbox.checked;
    });

    annulationClose.addEventListener('click', function () {
        annulationModal.classList.remove('active');
    });

    annulationModal.addEventListener('click', function (event) {
        if (event.target === annulationModal) {
            annulationModal.classList.remove('active');
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            annulationModal.classList.remove('active');
        }
    });

    annulationConfirm.addEventListener('click', function () {
        if (!annulationCheckbox.checked) {
            return;
        }
        changementStatutAnnuler().catch(function (erreur) {
            console.error('Erreur lors de la mise à jour du statut de la commande :', erreur);
        });
        annulationModal.classList.remove('active');
        chargerCommandesUser().catch(function (erreur) {
            console.error('Erreur lors du chargement des commandes :', erreur);
        });
    });
}

const avisModal = document.querySelector('#commentaire-modal-user');
const avisModalClose = document.querySelector('#commentaire-modal-user-close');
const avisBtnConfirmer = document.querySelector('.btn-commentaire-user-confirmer');

if (avisModalClose && avisBtnConfirmer && avisModal) {

    function ouvrirAvisModal(commande) {
        avisModal.dataset.commandId = commande['commande_id'];

        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const datePrestation = new Date(commande['date_prestation']);
        const datePrestationString = datePrestation.toLocaleDateString('fr-FR', options);

        document.querySelector('#commentaire-numero-user').textContent = commande['numero_commande'];
        document.querySelector('#commentaire-date-prestation-user').textContent = capitalizeFirstLetter(datePrestationString);

        totalStars = 0;
        updateStars();
        document.querySelector('#commentaire-content-textarea').value = '';

        avisModal.classList.add('active');
    }

    const stars = document.querySelectorAll('.star');
    let totalStars = 0;

    function updateStars() {
        stars.forEach(function (star, index) {
            if (index < totalStars) {
                star.classList.add('active');
            } else {
                star.classList.remove('active');
            }
        });
        document.querySelector('#star-result').textContent = `Note de : ${totalStars}/5`;
    }

    stars.forEach(function (star, index) {
        star.addEventListener('click', function () {
            totalStars = index + 1;
            updateStars();
        });
    });

    avisModal.addEventListener('click', async function (event) {
        const boutonAvisConfirmer = event.target.closest('.btn-commentaire-user-confirmer');
        if (!boutonAvisConfirmer) return;

        const commandeId = avisModal.dataset.commandId;

        const commentaire = document.querySelector('#commentaire-content-textarea');

        const donnees = new FormData();
        donnees.append('commande_id', commandeId);
        donnees.append('etoile_nombre', totalStars);
        donnees.append('commentaire', commentaire.value);
        donnees.append('csrf_token', getCsrfToken());

        const reponse = await fetch('avis-post.php', {
            method: 'POST',
            body: donnees
        });
        const resultat = await reponse.json();

        if (resultat['success']) {
            avisModal.classList.remove('active');
            chargerCommandesUser().catch(function (erreur) {
                console.error('Erreur lors du chargement des commandes utilisateur :', erreur);
            });
            const validationAvis = document.querySelector('.validation-avis');
            validationAvis.textContent = "Votre avis a bien été reçu !";
            setTimeout(function () {
                validationAvis.textContent = "";
            }, 3600);
        } else {
            console.error(resultat['message']);
        }
    });

    avisModalClose.addEventListener('click', function () {
        avisModal.classList.remove('active');
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            avisModal.classList.remove('active');
        }
    });

    avisModal.addEventListener('click', function (event) {
        if (event.target === avisModal) {
            avisModal.classList.remove('active');
        }
    });
}