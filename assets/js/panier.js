const panierContainer = document.querySelector('#panier-container');

if (panierContainer) {

    async function chargerItem() {
        const reponse = await fetch('panier.php');
        const items = await reponse.json();

        afficherItem(items);
    }

    function afficherItem(items) {
        const conteneur = document.querySelector('#panier-container');
        conteneur.querySelectorAll('.panier-info-box, .card-recap').forEach(function (ligne) {
            ligne.remove();
        });

        let totalGeneral = 0;

        items.forEach(function (item) {
            const ligne = document.createElement('div');
            ligne.classList.add('panier-info-box');
            ligne.dataset.uniqueId = item['uniqueId'];
            ligne.dataset.minimum = item['nombre_personne_minimum'];
            ligne.innerHTML = `
                <div class="img-panier-box">
                <img src="${item['image_url']}" alt="Image du Produit">
                </div>
                <div class="item-card">
                    <div class="item-info">
                        <div class="item-details">
                            <h2 data-label="nom du produit">${item['titre']}</h2>
                            <p class="item-quantite" data-label="quantite">Quantité de repas préparés :<br>
                                <button type="button" class="btn-moins">−</button>
                                <span class="quantite-valeur">${item['quantite']}</span>
                                <button type="button" class="btn-plus">+</button>
                            </p>
                            <p>Indique le nombre de repas préparés lors de votre evenement.<br>Veuillez-vous referer au nombre de personnes minimum.</p>
                            <p class="item-condition" data-label="conditions">Information de réservation :<br><span class="conditions-text">=> ${item['conditions']}</span></p>
                            <p class="item-nrb-min" data-label="nombre_personne_minimum">Nombre minimum de personnes :<br><span class="nrb-min-valeur">=> ${item['nombre_personne_minimum']}</span></p>
                            <p class="item-description" data-label="description">${item['description']}</p>
                        </div>
                    </div>
                    <div class="item-prix" data-label="prix_par_personne">Prix par personne :<br><span class="prix-valeur">=> ${item['prix_par_personne']} €</span></div>
                    <div></div>
                    <div class="btn-supprimer-item-box">
                        <button type="button" class="bouton-2">Supprimer</button>
                    </div>
                </div>
            `;
            conteneur.appendChild(ligne);

            totalGeneral += Number(item['prix_total']);
        });


        const recap = document.createElement('div');
        recap.classList.add('card-recap');
        recap.innerHTML = `
                <h2>Total : ${totalGeneral} €</h2>
                <div class="btn-passer-commande-box" id="btn-passer-commande-box">
                    <button type="button" class="animated-button" id="btn-passer-commande">
                        <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                            ></path>
                        </svg>
                        <span class="text">Passer commande</span>
                        <span class="circle"></span>
                        <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                            ></path>
                        </svg>
                    </button>
                </div>
            `;
        conteneur.appendChild(recap);
    }

    chargerItem().catch(function (erreur) {
        console.error('Erreur lors du chargement du panier :', erreur);
    });

    panierContainer.addEventListener('click', async function (event) {
        const boutonSupprimer = event.target.closest('.bouton-2');
        const boutonPlus = event.target.closest('.btn-plus');
        const boutonMoins = event.target.closest('.btn-moins');

        if (boutonSupprimer) {
            const ligne = boutonSupprimer.closest('.panier-info-box');
            const uniqueId = ligne.dataset.uniqueId;

            const donnees = new FormData();
            donnees.append('action', 'supprimer');
            donnees.append('unique_id', uniqueId);

            await fetch('panier.php', { method: 'POST', body: donnees });
            await chargerItem().catch(function (erreur) {
                console.error('Erreur lors du chargement du panier :', erreur);
            });
        }

        if (boutonPlus || boutonMoins) {
            const ligne = (boutonPlus || boutonMoins).closest('.panier-info-box');
            const uniqueId = ligne.dataset.uniqueId;
            const minimum = parseInt(ligne.dataset.minimum);
            const spanQuantite = ligne.querySelector('.quantite-valeur');
            let quantiteActuelle = parseInt(spanQuantite.textContent);

            quantiteActuelle = boutonPlus ? quantiteActuelle + 1 : Math.max(minimum, quantiteActuelle - 1);

            const donnees = new FormData();
            donnees.append('action', 'modifier');
            donnees.append('unique_id', uniqueId);
            donnees.append('quantite', quantiteActuelle);

            await fetch('panier.php', { method: 'POST', body: donnees });
            await chargerItem().catch(function (erreur) {
                console.error('Erreur lors du chargement du panier :', erreur);
            });
        }
    });
}

