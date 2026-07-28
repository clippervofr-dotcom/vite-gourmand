const panierContainer = document.querySelector('#panier-container');

if (panierContainer) {

    async function chargerItem() {
        const reponse = await fetch('panier.php');
        const items = await reponse.json();

        afficherItem(items);
    }

    function afficherItem(items) {
        const conteneur = document.querySelector('#panier-container');
        conteneur.querySelectorAll('.panier-info-box').forEach(function (ligne) {
            ligne.remove();
        });

        let totalGeneral = 0;

        items.forEach(function (item) {
            const ligne = document.createElement('div');
            ligne.classList.add('panier-info-box');
            ligne.dataset.uniqueId = item['uniqueId'];
            ligne.innerHTML = `
                <div class="img-panier-box">
                <img src="${item['image_url']}" alt="Image du Produit">
                </div>
                <div class="item-card">
                    <div class="item-info">
                        <div class="item-details">
                            <h2 data-label="nom du produit">${item['titre']}</h2>
                            <p data-label="quantite">Quantité :
                                <button type="button" class="btn-quantite-moins">−</button>
                                <span class="quantite-valeur">${item['quantite']}</span>
                                <button type="button" class="btn-quantite-plus">+</button>
                            </p>
                            <p data-label="description">${item['description']}</p>
                            <p data-label="conditions">Information de réservation : ${item['conditions']}</p>
                            <p data-label="nombre_personne_minimum">Nombre minimum de personnes : ${item['nombre_personne_minimum']}</p>
                        </div>
                    </div>
                    <div class="item-prix" data-label="prix_par_personne">Prix par personne : ${item['prix_par_personne']} €</div>
                    <button type="button" class="btn-supprimer-item">Supprimer</button>
                </div>
            `;
            conteneur.appendChild(ligne);

            totalGeneral += Number(item['prix_total']);
        });


        const recap = document.createElement('div');
        recap.classList.add('card-recap');
        recap.innerHTML = `
                <h2>Total : ${totalGeneral}</h2>
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
        const boutonSupprimer = event.target.closest('.btn-supprimer-item');
        const boutonPlus = event.target.closest('.btn-quantite-plus');
        const boutonMoins = event.target.closest('.btn-quantite-moins');

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
            const spanQuantite = ligne.querySelector('.quantite-valeur');
            let quantiteActuelle = parseInt(spanQuantite.textContent);

            quantiteActuelle = boutonPlus ? quantiteActuelle + 1 : Math.max(1, quantiteActuelle - 1);

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

