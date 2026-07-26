<!--modale faire un devis-->

<div id="devis-modal" class="modal-overlay">
    <div class="modal-box">
        <button type="button" class="modal-close" id="devis-close" aria-label="Fermer la fenêtre">&times;</button>

        <form class="form-page" id="devis-form" action="" method="post">
            <img src="assets/images/devis-banner.png" alt="Banner">
            <p class="form-description">Parlons de votre événement<br>Demandez votre devis traiteur en quelques
                clics.</p>


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
                <input type="tel" inputmode="numeric" pattern="[0-9]{10}" id="tel" name="contact-tel" required>
            </div>

            <div class="form-date">
                <label for="date">Date :</label>
                <input type="date" id="date" name="contact-date" required>
            </div>

            <div class="form-email">
                <label for="email">Email :</label>
                <input type="email" id="email" name="contact-email" required>
            </div>

            <div class="form-texte">
                <label for="form-texte">Message :</label>
                <textarea class="form-texte" id="form-texte" name="contact-texte" required></textarea>
            </div>

            <div class="form-checkbox">
                <label class="checkbox-custom">
                    <input type="checkbox" id="validation" required>
                    <div class="checkbox-mark"></div>
                    <span>J'accepte que l'on me contacte pour cette demande</span>
                </label>
            </div>

            <div class="form-submit">
                <button class="form-submit-button" type="submit" id="form-submit-button"
                        name="contact-submit-button">Envoyer
                </button>
            </div>
            <p id="devis-erreur" class="erreur"></p>
        </form>
    </div>
</div>

<div id="devis-confirmation" class="modal-overlay">
    <div class="modal-box modal-box-petite">
        <button type="button" class="modal-close" id="confirmation-close"
                aria-label="Fermer la fenêtre">&times;
        </button>
        <h2>Merci !</h2>
        <p>Votre demande de devis a bien été envoyée. Nous revenons vers vous très vite.</p>
    </div>
</div>

<!-- modale cartes menus -->

<div id="menu-detail-modal" class="modal-overlay">
    <div class="modal-box">
        <button type="button" class="modal-close" id="menu-detail-close" aria-label="Fermer la fenêtre">&times;</button>

        <div class="menu-detail-content">
            <img id="menu-detail-img" src="" alt="">
            <h2 id="menu-detail-titre"></h2>
            <p id="menu-detail-description"></p>
            <p id="menu-detail-stock"></p>
            <p id="menu-detail-prix"></p>

            <div class="menu-detail-quantite">
                <button type="button" class="btn-moins" id="menu-detail-btn-moins" aria-label="Diminuer la quantité">−</button>
                <input type="number" id="menu-detail-input" value="0" min="0" aria-label="Quantité" inputmode="numeric" required>
                <button type="button" class="btn-plus" id="menu-detail-btn-plus" aria-label="Augmenter la quantité">+</button>
            </div>

            <p id="menu-detail-prix-calcule"></p>

            <p id="menu-detail-reduc"></p>
            <button type="button" class="animated-button" id="menu-detail-ajouter">
                <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                    ></path>
                </svg>
                <span class="text">Ajouter au panier</span>
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

<!-- Modale annulation commande -->

<div class="modal-overlay" id="annulation-modal">
    <div class="modal-box">
        <button type="button" class="modal-close" id="annulation-modal-close" aria-label="Fermer la fenêtre">&times;</button>

        <div class="annulation-content">
            <h2>Annuler la commande</h2>
            <p id="annulation-numero"></p>
            <p id="annulation-date-prestation"></p>
            <p id="annulation-reglement"></p>

            <label class="checkbox-custom">
                <input type="checkbox" id="annulation-checkbox">
                <div class="checkbox-mark"></div>
                <span>Je confirme avoir pris connaissances<br> des conséquences liées à cette annulation.</span>
            </label>

            <button type="button" class="animated-button" id="btn-annulation-commande">
                <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                    ></path>
                </svg>
                <span class="text">Confirmer l'annulation</span>
                <span class="circle"></span>
                <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                    ></path>
                </svg>
            </button>
            <p id="annulation-erreur" class="erreur"></p>
        </div>
    </div>
</div>


<!-- Modale Panier confirmation -->
<div id="panier-confirmation-modal" class="modal-overlay">
    <div class="modal-box modal-box-petite">
        <button type="button" class="modal-close" id="panier-confirmation-close" aria-label="Fermer la fenêtre">&times;</button>

        <h2>Menu ajouté au panier ✓</h2>

        <div class="btn-panier-confirm-box">
            <a >
                <span class="text">Voir mon panier</span>
            </a>
            <a href="panier.php" class="animated-button" id="btn-voir-panier">
                <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                    ></path>
                </svg>
                <span class="text">Voir mon panier</span>
                <span class="circle"></span>
                <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                    ></path>
                </svg>
            </a>
            <button type="button" class="animated-button" id="btn-continuer-panier">
                <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                    ></path>
                </svg>
                <span class="text">Continuer ma balade</span>
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



<!-- Modale inscrire new adresse -->
<!---->
<!--<div class="modal-overlay" id="new-adresse-modal">-->
<!--    <div class="modal-box">-->
<!--        <button type="button" class="modal-close" id="new-adresse-modal-close" aria-label="Fermer la fenêtre">&times;</button>-->
<!---->
<!--        <form class="new-adresse-content" method="post" action="test-new-adresse.php">-->
<!---->
<!--            <div class="new-adresse-nom">-->
<!--                <label for="new-adresse-nom">Adresse :</label>-->
<!--                <input type="text" id="new-adresse-nom" name="new-adresse-nom" autocomplete="address-line1" required>-->
<!--            </div>-->
<!---->
<!--            <div class="new-adresse-code-postal">-->
<!--                <label for="new-adresse-code-postal">Code Postal :</label>-->
<!--                <input type="number" inputmode="numeric" pattern="[0-9]{5}" maxlength="5" id="new-adresse-code-postal" name="new-adresse-code-postal" autocomplete="postal-code" required>-->
<!--            </div>-->
<!---->
<!--            <div class="new-adresse-ville">-->
<!--                <label for="new-adresse-ville">Ville :</label>-->
<!--                <input type="text" id="new-adresse-ville" name="new-adresse-ville" autocomplete="address-level2" required>-->
<!--            </div>-->
<!---->
<!--            <label class="checkbox-custom">-->
<!--                <input type="checkbox" id="new-adresse-checkbox" required>-->
<!--                <div class="checkbox-mark"></div>-->
<!--                <span>Je confirme que les informations sont conformes.</span>-->
<!--            </label>-->
<!--            <div class="new-adresse-btn-box">-->
<!--                <button type="button" class="animated-button" id="btn-new-adresse-confirm">-->
<!--                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">-->
<!--                        <path-->
<!--                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"-->
<!--                        ></path>-->
<!--                    </svg>-->
<!--                    <span class="text">Confirmer</span>-->
<!--                    <span class="circle"></span>-->
<!--                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">-->
<!--                        <path-->
<!--                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"-->
<!--                        ></path>-->
<!--                    </svg>-->
<!--                </button>-->
<!--            </div>-->
<!---->
<!---->
<!--            <p id="new-adresse-erreur" class="erreur"></p>-->
<!--        </form>-->
<!--    </div>-->
<!--</div>-->











<footer>
    <ul class="cgv-ml-contact-footer">
        <li><a href="contact.php">Contact</a></li>
        <li><a href="cgv.php">Conditions Générales de Vente</a></li>
        <li><a href="mentions-legales.php">Mentions Légales</a></li>
    </ul>
    <img src="assets/images/logo1_background_less.png" alt="Vite & Gourmand"/>
    <div class="footer-horaires">
        <p>Horaires :</p>
        <p>Lundi - Vendredi: 9h00 - 18h00</p>
        <p>Samedi:<br>9h00 - 13h00</p>
        <p>Dimanche: Fermé</p>
    </div>

</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="assets/js/fonction.js"></script>
<script src="assets/js/forms.js"></script>
<script src="assets/js/menus.js"></script>
<script src="assets/js/profil.js"></script>
<script src="assets/js/commandes.js"></script>
<script src="assets/js/commandes-utilisateur.js"></script>
<script src="assets/js/commandes-post.js"></script>



</div>
</html>