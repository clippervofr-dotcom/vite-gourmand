const commandeBox = document.querySelector('.commande-box');

if (commandeBox) {

    async function chargerItems() {
        const reponse = await fetch('panier-commande.php');
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

        console.log(utilisateur);
        console.log(menu);

        const ligne = document.createElement('div');
        ligne.classList.add('recap-commande-box');

        const locationMaterielCheckbox = document.querySelector('#materiel');
        const distanceKm = utilisateur['distance'];
        let prixSurplusKm = 1.5;
        let prixTotalDistance = 0;
        let totalGeneral = 0;

        if (locationMaterielCheckbox.checked) {
            totalGeneral += Number(menu['prix_total'] + parseInt(locationMaterielCheckbox.dataset.location));
        } else {
            totalGeneral += Number(menu['prix_total']);
        }

        if (distanceKm > 5) {
            prixTotalDistance += (prixSurplusKm * distanceKm);
            totalGeneral += prixTotalDistance;
        }

        ligne.innerHTML = `
            <div class="recap-infos">
                <div class="recap-liste">
                    <p class="recap-intitule">Menu :</p>
                    <p class="recap-resultat">${menu['titre']}</p>
                </div>
                <div class="recap-liste">
                    <p class="recap-intitule">Nombre de personnes :</p>
                    <p class="recap-resultat">${menu['quantite']}</p>
                </div>
                <div class="recap-liste">
                    <p class="recap-intitule">Adresse :</p>
                    <p class="recap-resultat">${utilisateur['adresse']}</p>
                </div>
                <div class="recap-liste">
                    <p class="recap-intitule">Date de livraison :</p>
                    <p class="recap-resultat"></p>
                </div>
                <div class="recap-liste">
                    <p class="recap-intitule">Forfait location de matériel :</p>
                    <p class="recap-resultat"></p>
                </div>
                <div class="recap-liste">
                    <p class="recap-intitule">Prix de la livraison :</p>
                    <p class="recap-resultat">${prixTotalDistance} €</p>
                </div>
            </div>
            <div class="recap-prix">
                <p>Total : ${totalGeneral} €</p>
            </div>
        `;
        conteneur.appendChild(ligne);
    }
}


// btn validation
