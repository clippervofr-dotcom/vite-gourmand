<?php $css_pages = ['home'];
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Config/root-path.php';
require ROOT_PATH . '/src/Views/partials/header.php';
?>

<main>
    <h1 class="visually-hidden">Vite & Gourmand — traiteur événementiel à Bordeaux</h1>
    <section class="hero">
        <img src="assets/images/banniere-traiteur-2.png" alt="Traiteur depuis 25 ans à Bordeaux">
        <a href="menus/menus.php" class="bouton-menus" id="btn-menus-hero">Voir nos menus</a>
    </section>

    <img src="assets/images/border2.png" alt="Bordure décorative" class="border">

    <section class="presentation">

        <div class="presentation-jose">
            <div class="presentation-jose-img">
                <img src="assets/images/arrow-jose.png" alt="Flèche pointant vers José, le chef de cuisine !">
                <img src="assets/images/jose.png" class="jose-img" alt="José, le chef de cuisine !">
            </div>
        </div>

        <div class="presentation-texte">
            <div  class="equipe-passion">
                <img src="assets/images/equipe-passionnee.png" alt="Une équipe passionnée à votre service">
            </div>
            <div class="presentation-detail">
                <div class="presentation-produits-frais">
                    <h3>Des produits frais !</h3>
                    <picture class="presentation-produits-frais-deff-bulle">
                        <source srcset="assets/images/produits-frais-texte-mobile.png" media="(max-width: 900px)">
                        <img src="assets/images/produits-frais-texte.png" alt="Des produits frais">
                    </picture>
                </div>

                <div class="presentation-livraison">
                    <h3>Livraison sur place !</h3>
                    <picture class="presentation-livraison-deff-bulle">
                        <source srcset="assets/images/livraison-texte-mobile.png" media="(max-width: 900px)">
                        <img src="assets/images/livraison-texte.png" alt="Livraison sur place">
                    </picture>
                </div>
            </div>
        </div>

        <div class="presentation-julie">
            <div class="presentation-julie-img">
                <img src="assets/images/julie.png" class="julie-img" alt="Julie, sa fidèle assistante !">
                <img src="assets/images/arrow-julie.png" alt="Flèche pointant vers Julie, sa fidèle assistante !">
            </div>
        </div>
    </section>


    <section class="avis">
        <div class="avis-texte-img">
            <button type="button" class="bouton-avis-prec" id="avis-prec" aria-label="Avis précédent">
                <img src="assets/images/arrow-left.png" class="arrow-avis" alt="">
            </button>
            <img src="assets/images/avis-clients.png" alt="Avis Clients">
            <button type="button" class="bouton-avis-suiv" id="avis-suiv" aria-label="Avis suivant">
                <img src="assets/images/arrow-right.png" class="arrow-avis" alt="">
            </button>
        </div>
        <div class="commentaires">
            <img src="assets/images/avis1.png" alt="Avis Clients">
            <div class="commentaires-mega-box">
            <!-- ICI AVIS JS -->
            </div>
            <img src="assets/images/avis2.png" alt="Avis Clients">
        </div>
    </section>


    <section class="partenaires">
        <div class="partenaires-texte-img">
            <img src="assets/images/nos-partenaires.png" alt="Nos Partenaires">
        </div>
        <div class="partenaires-box">
            <div class="partenaires-liste">
                <img src="assets/images/logoP1-removebg-preview.png" class="partenaires-logo" alt="La ferme du chêne">
                <img src="assets/images/logoP2-removebg-preview.png" class="partenaires-logo" alt="Le moulin d'antan">
                <img src="assets/images/logoP3-removebg-preview.png" class="partenaires-logo" alt="Le potager bio">
                <img src="assets/images/logoP4-removebg-preview.png" class="partenaires-logo" alt="l'artisan boulanger">
                <img src="assets/images/logoP5-removebg-preview.png" class="partenaires-logo" alt="le vignoble du val">
                <img src="assets/images/logoP6-removebg-preview.png" class="partenaires-logo" alt="l'éleveur du pré">
                <img src="assets/images/logoP7-removebg-preview.png" class="partenaires-logo" alt="La poissonnerie du port">
                <img src="assets/images/logoP8-removebg-preview.png" class="partenaires-logo" alt="Miel du terroir">

                <img src="assets/images/logoP1-removebg-preview.png" class="partenaires-logo" alt="La ferme du chêne">
                <img src="assets/images/logoP2-removebg-preview.png" class="partenaires-logo" alt="Le moulin d'antan">
                <img src="assets/images/logoP3-removebg-preview.png" class="partenaires-logo" alt="Le potager bio">
                <img src="assets/images/logoP4-removebg-preview.png" class="partenaires-logo" alt="l'artisan boulanger">
                <img src="assets/images/logoP5-removebg-preview.png" class="partenaires-logo" alt="le vignoble du val">
                <img src="assets/images/logoP6-removebg-preview.png" class="partenaires-logo" alt="l'éleveur du pré">
                <img src="assets/images/logoP7-removebg-preview.png" class="partenaires-logo" alt="La poissonnerie du port">
                <img src="assets/images/logoP8-removebg-preview.png" class="partenaires-logo" alt="Miel du terroir">
            </div>
        </div>
    </section>
    <div id="btn-to-top-box">
        <button type="button" id="btn-to-top">
            <svg id="svgIcon" viewBox="0 0 384 512">
                <path
                        d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"
                ></path>
            </svg>
        </button>
    </div>

</main>

<?php require ROOT_PATH . '/src/Views/partials/footer.php'; ?>


