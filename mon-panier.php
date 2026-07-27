<?php $css_pages = ['menus']; ?>
<?php require 'includes/header.php'; ?>

<main class="main-mon-panier">
    <div class="panier-container" id="panier-container">
        <h1>Votre Panier</h1>
        <div class="panier-info-box">
            <div class="img-panier-box">
                <img src="assets/images/noel.png" alt="Image du Produit">
            </div>
            <div class="item-card">
                <div class="item-info">
                    <div class="item-details">
                        <h2 data-label="nom du produit">Menu de Noël</h2>
                        <p data-label="quantite">Quantité : 1</p>
                        <p data-label="description">Description du produit</p>
                        <p data-label="conditions">Information de réservation</p>
                    </div>
                </div>
                <div class="item-prix" data-label="prix_par_personne">Prix par personne : 29,99 €</div>
            </div>
            <div class="card-recap">
                <h2>Total : 29,99 €</h2>
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
            </div>
        </div>

    </div>
</main>

<?php require 'includes/footer.php'; ?>