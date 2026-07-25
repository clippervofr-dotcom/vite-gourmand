// gestion et affichages commandes en attente de validation + en attente/validée
const conteneurCommandes = document.querySelector('.profil-employe-commandes-liste');

if (conteneurCommandes) {
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

        commandesEnAttente.forEach(function (commande) {
            const ligne = document.createElement('div');
            ligne.classList.add('profil-employe-commandes-ligne');
            ligne.innerHTML = `
                <span class="commandes-champ" data-label="Commande n°">${commande['numero_commande']}</span>
                <span class="commandes-champ" data-label="Nom du menu">${commande['titre']}</span>
                <span class="commandes-champ" data-label="Nbr de personnes">${commande['nombre_personnes']}</span>
                <span class="commandes-champ" data-label="Date prestation">${commande['date_prestation']}</span>
                <span class="commandes-champ" data-label="Status">${commande['statut']}</span>
                <span class="commandes-champ" data-label="Commentaires">${commande['motif_annulation'] ?? '-'}</span>
                <button type="button" class="btn-validation-commande">
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
                </button>
                <button type="button" class="btn-voir-detail-commande">
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
            `;
            conteneur.appendChild(ligne);
        });

        const btnStatut = document.querySelector('#btn-statut-commande');

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
    }

    chargerCommandesEnAttente().catch(function (erreur) {
        console.error('Erreur lors du chargement des commandes en attente :', erreur);
    });
}

//gestion des commandes de l'utilisateur


