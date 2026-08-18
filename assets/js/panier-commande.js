const commandeBox = document.querySelector('.commande-box');

if (commandeBox) {
    async function chargerItems() {
        const params = new URLSearchParams(window.location.search);
        const itemId = params.get('item');

        const reponse = await fetch('panier-commande.php?item=' + encodeURIComponent(itemId));
        const resultat = await reponse.json();

        if (!resultat['success']) {
            console.error(resultat['message']);
        }

        const utilisateur = resultat['info'];
        const menu = resultat['panier'];

        document.querySelector('#nom-commande').value = utilisateur['nom'];
        document.querySelector('#prenom-commande').value = utilisateur['prenom'];
        document.querySelector('#email-commande').value = utilisateur['email'];
        document.querySelector('#telephone-commande').value = utilisateur['telephone'];
        document.querySelector('#adresse-commande').value = utilisateur['adresse'];
        document.querySelector('#ville-commande').value = utilisateur['ville'];
        document.querySelector('#code-postal-commande').value = utilisateur['code_postal'];
        document.querySelector('#choix-menu').value = menu['titre'];
        document.querySelector('#nbr-personnes-commande').value = menu['quantite'];

        afficherRecapPanier(resultat);
    }

    function afficherRecapPanier(resultat) {
        const conteneur = document.querySelector('.commande-box-3');
        conteneur.querySelectorAll('.recap-commande-box').forEach(function (ligne) {
            ligne.remove();
        });

        const utilisateur = resultat['info'];
        const menu = resultat['panier'];

        const locationMaterielCheckbox = document.querySelector('#materiel');
        const dateLivraisonInput = document.querySelector('#date-heure');

        function calculerTotal() {
            document.querySelector('.recap-prix p').textContent =
                `Total : ${locationMaterielCheckbox.checked ? utilisateur['total_avec_materiel'] : utilisateur['total_sans_materiel']} €`;
        }

        function dateLivraisonRecap() {
            if (!dateLivraisonInput.value) {
                document.querySelector('#recap-date-livraison').textContent = 'Non renseignée';
                return;
            }
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const datePrestation = new Date(dateLivraisonInput.value);
            document.querySelector('#recap-date-livraison').textContent = datePrestation.toLocaleDateString('fr-FR', options);
        }

        function modifPrixMateriel() {
            document.querySelector('#recap-forfait-materiel').textContent =
                locationMaterielCheckbox.checked ? `${utilisateur['prix_materiel']} €` : 'Non sélectionné';
        }

        const ligne = document.createElement('div');
        ligne.classList.add('recap-commande-box');
        ligne.innerHTML = `
            <div class="recap-infos">
                <div class="recap-liste">
                    <p class="recap-intitule">Menu :</p>
                    <p class="recap-resultat">${echapperHTML(menu['titre'])}</p>
                </div>
                <div class="recap-liste">
                    <p class="recap-intitule">Nombre de personnes :</p>
                    <p class="recap-resultat">${echapperHTML(menu['quantite'])}</p>
                </div>
                <div class="recap-liste">
                    <p class="recap-intitule">Adresse :</p>
                    <p class="recap-resultat">${echapperHTML(utilisateur['adresse'])}</p>
                </div>
                <div class="recap-liste">
                    <p class="recap-intitule">Date de livraison :</p>
                        <p class="recap-resultat" id="recap-date-livraison"></p>
                </div>
                <div class="recap-liste">
                    <p class="recap-intitule">Forfait location de matériel :</p>
                    <p class="recap-resultat" id="recap-forfait-materiel"></p>
                </div>
                <div class="recap-liste">
                    <p class="recap-intitule">Prix de la livraison :</p>
                    <p class="recap-resultat" id="recap-prix-livraison">${utilisateur['prix_livraison']} €</p>
                </div>
            </div>
            <div class="recap-prix">
                <p>Total : 0 €</p>
            </div>
            <div class="recap-commande-bouton-confirmation">
                <button class="animated-button" type="button" id="btn-confirmation-commande">
                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                    <span class="text">Confirmer la commande</span>
                    <span class="circle"></span>
                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                </button>
                <p>Un mail de confirmation vous sera envoyé après validation de la commande</p>
            </div>
        `;
        conteneur.appendChild(ligne);

        calculerTotal();
        dateLivraisonRecap();
        modifPrixMateriel();

        locationMaterielCheckbox.addEventListener('change', function() {
            calculerTotal();
            modifPrixMateriel();
        });

        dateLivraisonInput.addEventListener('change', dateLivraisonRecap);
    }
    chargerItems().catch(function (erreur) {
        console.error('Erreur lors du chargement de la commande :', erreur);
    });
}

