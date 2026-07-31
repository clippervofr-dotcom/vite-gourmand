//UTILISATEUR -- Affichage des commandes
const conteneurCommandesUser = document.querySelector('.profil-utilisateur-commandes-liste');
let derniereCommandesRecues = [];

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

        commandesUser.forEach(function (commande) {
            const ligne = document.createElement('div');
            ligne.classList.add('profil-utilisateur-commandes-ligne');
            ligne.dataset.commandeId = commande['commande_id'];
            ligne.innerHTML = `
                <span class="commandes-champ" data-label="Commande n°">${commande['numero_commande']}</span>
                <span class="commandes-champ" data-label="Nom du menu">${commande['titre']}</span>
                <span class="commandes-champ" data-label="Nbr de personnes">${commande['nombre_personnes']}</span>
                <span class="commandes-champ" data-label="Date prestation">${commande['date_prestation']}</span>
                <span class="commandes-champ" data-label="Status">${commande['statut']}</span>
                <span class="commandes-champ" data-label="Commentaires">${commande['motif_annulation'] ?? '-'}</span>   
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
            `;
            conteneurUser.appendChild(ligne);
        });
    }

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
        document.querySelector('#annulation-numero').textContent = `Commande :\n ${commande['numero_commande']}`;
        document.querySelector('#annulation-date-prestation').textContent = `Date de prestation :\n ${commande['date_prestation']}`;
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

        return  fetch ('commandes-utilisateur-annuler.php', {
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






