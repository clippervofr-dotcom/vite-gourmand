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

        function calculerTotal() {
            let prixSurplusKm = 1.5;
            let prixTotalDistance = 0;
            let totalGeneral = 0;
            const distanceKm = utilisateur['distance'];

            if (locationMaterielCheckbox.checked) {
                totalGeneral += Number(menu['prix_total'] + parseInt(locationMaterielCheckbox.dataset.location));
            } else {
                totalGeneral += Number(menu['prix_total']);
            }

            if (distanceKm > 5) {
                prixTotalDistance += (prixSurplusKm * distanceKm);
                totalGeneral += prixTotalDistance;
            }

            document.querySelector('.recap-prix p').textContent = `Total : ${totalGeneral} €`;
            document.querySelector('#recap-prix-livraison').textContent = `Prix de la livraison : ${prixTotalDistance} €`;
        }

        const ligne = document.createElement('div');
        ligne.classList.add('recap-commande-box');
        ligne.innerHTML = `
            <div class="recap-infos">
                <div class="recap-liste">
                    <p class="recap-intitule">Menu :</p>
                    <p class="recap-resultat">${menu['titre']}</p>
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
                    <p class="recap-resultat">${echapperHTML(utilisateur['date_livraison'])}</p>
                </div>
                <div class="recap-liste">
                    <p class="recap-intitule">Forfait location de matériel :</p>
                    <p class="recap-resultat"></p>
                </div>
                <div class="recap-liste">
                    <p class="recap-intitule">Prix de la livraison :</p>
                    <p class="recap-resultat" id="recap-prix-livraison"></p>
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

        locationMaterielCheckbox.addEventListener('change', calculerTotal);
    }
    chargerItems().catch(function (erreur) {
        console.error('Erreur lors du chargement de la commande :', erreur);
    });
}

