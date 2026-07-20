<?php $css_pages = ['forms']; ?>

<?php require 'includes/header.php'; ?>

<main>
    <form class="form-page" action="" method="post">

        <img src="assets/images/contact-banner.png" class="banner-contact" alt="Banner">
        <p class="form-description">Besoin d’informations ?<br>Écrivez-nous, nous vous répondrons avec plaisir.</p>


        <div class="form-nom">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="contact-nom" required>
        </div>

        <div class="form-prenom">
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="contact-prenom" required>
        </div>

        <div class="form-tel">
            <label for="tel">Téléphone :</label>
            <input
                    type="tel"
                    inputmode="numeric"
                    pattern="[0-9]{10}"
                    id="tel"
                    name="contact-tel"
                    required>
        </div>

        <div class="form-date">
            <label for="date">Date :</label>
            <input type="date" id="date" name="contact-date" required>
        </div>

        <div class="form-email">
            <label for="email">Email :</label>
            <input
                    type="email"
                    id="email"
                    name="contact-email"
                    required>
        </div>

        <div class="form-texte">
            <label for="form-texte">Message :</label>
            <textarea class="form-texte" id="form-texte" name="contact-texte" required></textarea>
        </div>

        <div class="form-checkbox">
            <label class="checkbox-custom">
                <input type="checkbox" id="validation">
                <div class="checkbox-mark"></div>
                <span>J'accepte que l'on me contact pour cette demande</span>
            </label>

            <!--            <input type="checkbox" class="form-checkbox-input" id="form-checkbox" name="form-checkbox" required>-->
<!--            <label for="form-checkbox" class="form-checkbox-label">J'accepte que l'on me forme pour cette-->
<!--                demande</label>-->
        </div>



        <div class="form-submit">
            <button class="form-submit-button" type="submit" id="form-submit-button" name="contact-submit-button">
                Envoyer
            </button>
        </div>
    </form>
    <div>
        <img src="assets/images/banniere-v&g.png" class="bottom-banner" alt="Banniere Vite & Gourmand">
    </div>
</main>


<?php require 'includes/footer.php'; ?>
