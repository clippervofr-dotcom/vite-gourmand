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

        afficherRecapPanier(resultat['panier']);
    }

    function afficherRecapPanier(items) {
        const conteneur = document.querySelector('.commande-box-3');
        conteneur.querySelectorAll('.recap-commande-box').forEach(function (ligne) {
            ligne.remove();
        });

        items.forEach(function (item) {
            const ligne = document.createElement('div');
            ligne.classList.add('recap-commande-box');

            const dateLivraison = document.querySelector('#date-commande');
            livraison = dateLivraison.dataset.dateLivraison


            let totalGeneral = 0;
            totalGeneral += Number(item['prix_total'] + locationMateriel);

            ligne.innerHTML = `
                    <div class="recap-infos">
                        <div class="recap-liste">
                            <p class="recap-intitule">Menu :</p>
                            <p class="recap-resultat">${item['titre']}</p>
                        </div>
                        <div class="recap-liste">
                            <p class="recap-intitule">Nombre de personnes :</p>
                            <p class="recap-resultat">${item['quantite']}</p>
                        </div>
                        <div class="recap-liste">
                            <p class="recap-intitule">Adresse :</p>
                            <p class="recap-resultat">${item['adresse']}</p>
                        </div>
                        <div class="recap-liste">
                            <p class="recap-intitule">Date de livraison :</p>
                            <p class="recap-resultat">Le ${livraison} à ${item['heure']}</p>
                        </div>
                        <div class="recap-liste">
                            <p class="recap-intitule">Forfait location de matériel :</p>
                            <p class="recap-resultat"></p>
                        </div>
                        <div class="recap-liste">
                            <p class="recap-intitule">Prix de la livraison :</p>
                            <p class="recap-resultat"> xx€</p>
                        </div>
                    </div>
                    <div class="recap-prix">
                        <p>Total : ${totalGeneral.toFixed(2)}€</p>
                    </div>
            `;
        });
    }

    // location materiel
    function locationMaterielCheckbox() {
        const locationCocher = document.querySelectorAll('#matériel[type="checkbox"]:checked');
        const location = Array.from(locationCocher).map(function (checkbox) {
            return checkbox.dataset.locationId;
        });
    }
}
