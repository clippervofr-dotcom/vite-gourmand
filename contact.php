<?php $css_pages = ['forms']; ?>

<?php require 'includes/header.php'; ?>

<main>
    <form class="form-page" action="" method="post">

        <img src="assets/images/contact-banner.png" class="banner-contact" alt="Banner">
        <p class="form-description">Besoin d’informations ?<br>Écrivez-nous, nous vous répondrons avec plaisir.</p>


        <div class="form-nom">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" pattern="^\b(?:\w|-)+\b$" name="contact-nom" required>
        </div>

        <div class="form-prenom">
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" pattern="^\b(?:\w|-)+\b$" name="contact-prenom" required>
        </div>

        <div class="form-tel">
            <label for="tel">Téléphone :</label>
            <input
                    type="tel"
                    inputmode="numeric"
                    pattern="^[0-9]{10}$"
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
                    pattern="^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$"
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
                <span>J'accepte d'etre recontacté.</span>
            </label>
        </div>



        <div class="form-submit">
            <button type="submit" id="form-submit-button" name="contact-submit-button">
                <div class="svg-wrapper-1">
                    <div class="svg-wrapper">
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                width="24"
                                height="24"
                        >
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path
                                    fill="currentColor"
                                    d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"
                            ></path>
                        </svg>
                    </div>
                </div>
                <span>Envoyer !</span>
            </button>
        </div>
    </form>
    <div>
        <img src="assets/images/banniere-v&g.png" class="bottom-banner" alt="Banniere Vite & Gourmand">
    </div>
</main>


<?php require 'includes/footer.php'; ?>
