<?php $css_pages = ['home']; ?>
<?php require 'includes/header.php'; ?>

<main>
    <section class="hero">
        <img src="assets/images/banniere-traiteur-2.png" alt="Traiteur depuis 25 ans à Bordeaux">
        <a href="menus.php" class="bouton-menus">Voir nos menus</a>
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
                    <h3>Des produits frais</h3>
                    <picture class="presentation-produits-frais-deff-bulle">
                        <source srcset="assets/images/produits-frais-texte-mobile.png" media="(max-width: 900px)">
                        <img src="assets/images/produits-frais-texte.png" alt="Des produits frais">
                    </picture>
                </div>

                <div class="presentation-livraison">
                    <h3>Livraison sur place</h3>
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
                <img src="assets/images/arrow-left.png" alt="">
            </button>
            <img src="assets/images/avis-clients.png" alt="Avis Clients">
            <button type="button" class="bouton-avis-suiv" id="avis-suiv" aria-label="Avis suivant">
                <img src="assets/images/arrow-right.png" alt="">
            </button>
        </div>
        <div class="commentaires">
            <img src="assets/images/avis1.png" alt="Avis Clients">
            <div class="commentaires-mega-box">
                <div class="commentaires-box">
                    <p class="auteur">Auteur 1</p>
                    <p class="commentaires-texte">"Commentaires 1"</p>
                    <p class="etoiles">★★★★★</p>
                </div>
                <div class="commentaires-box">
                    <p class="auteur">Auteur 2</p>
                    <p class="commentaires-texte">"Commentaires 2"</p>
                    <p class="etoiles">★★★★☆</p>
                </div>
                <div class="commentaires-box">
                    <p class="auteur">Auteur 3</p>
                    <p class="commentaires-texte">"Commentaires 3"</p>
                    <p class="etoiles">★★★★★</p>
                </div>
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
</main>

<?php require 'includes/footer.php'; ?>


