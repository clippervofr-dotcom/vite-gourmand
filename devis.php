
<?php $css_pages = ['forms']; ?>
<?php require 'includes/header.php'; ?>

<main>
    <div id="devis-modal" class="modal-overlay">
        <div class="modal-box">
            <button type="button" class="modal-close" id="devis-close" aria-label="Fermer la fenêtre">&times;</button>

            <form class="form-page" id="devis-form" action="" method="post">
                <img src="assets/images/devis-banner.png" alt="Banner">
                <p class="form-description">Parlons de votre événement<br>Demandez votre devis traiteur en quelques
                    clics.</p>
                

                <div class="form-nom">
                    <label for="nom">Nom :</label>
                    <input type="text" pattern="^\b(?:\w|-)+\b$" id="nom" name="contact-nom" required>
                </div>

                <div class="form-prenom">
                    <label for="prenom">Prénom :</label>
                    <input type="text" pattern="^\b(?:\w|-)+\b$" id="prenom" name="contact-prenom" required>
                </div>

                <div class="form-tel">
                    <label for="tel">Téléphone :</label>
                    <input type="tel" inputmode="numeric" pattern="^[0-9]{10}$" id="tel" name="contact-tel" required>
                </div>

                <div class="form-date">
                    <label for="date">Date :</label>
                    <input type="date" id="date" name="contact-date" required>
                </div>

                <div class="form-email">
                    <label for="email">Email :</label>
                    <input type="email" pattern="^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$" id="email" name="contact-email" required>
                </div>

                <div class="form-texte">
                    <label for="form-texte">Message :</label>
                    <textarea class="form-texte" id="form-texte" name="contact-texte" required></textarea>
                </div>

                <div class="form-checkbox">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="validation" required>
                        <div class="checkbox-mark"></div>
                        <span>J'accepte d'etre contacté.</span>
                    </label>
                </div>

                <div class="form-submit">
                    <button class="form-submit-button" type="submit" id="form-submit-button"
                        name="contact-submit-button">C'est parti !</button>
                </div>
                <p id="devis-erreur" class="erreur"></p>
            </form>
        </div>
    </div>

    <div id="devis-confirmation" class="modal-overlay">
        <div class="modal-box modal-box-petite">
            <button type="button" class="modal-close" id="confirmation-close"
                aria-label="Fermer la fenêtre">&times;</button>
            <h2>Merci !</h2>
            <p>Votre demande de devis a bien été envoyée. Nous revenons vers vous très vite.</p>
        </div>
    </div>

    <div>
        <img src="assets/images/banniere-v&g.png" class="bottom-banner" alt="Banniere Vite & Gourmand">
    </div>
</main>


<?php require 'includes/footer.php'; ?>