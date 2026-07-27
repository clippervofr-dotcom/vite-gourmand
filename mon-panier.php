<?php $css_pages = ['menus']; ?>
<?php require 'includes/header.php'; ?>

<main class="main-mon-panier">
    <div class="panier-container">
        <h1>Votre Panier</h1>

        <div class="img-panier-box">
            <img src="assets/images/noel.png" alt="Image du Produit">
        </div>
        <div class="item-card">
            <div class="item-info">
                <div class="item-details">
                    <h2 data-name="nom du produit">Menu de Noël</h2>
                    <p data-quantite="quantite">Quantité : 1</p>
                </div>
            </div>
            <div class="item-prix">29,99 €</div>
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
</main>

<?php require 'includes/footer.php'; ?>