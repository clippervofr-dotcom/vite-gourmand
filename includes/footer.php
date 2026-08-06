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
            <p id="menu-detail-personne-minimum"></p>

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

            <button type="button" class="animated-button" id="btn-annulation-confirmer">
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
            <a href="mon-panier.php" class="animated-button" id="btn-voir-panier">
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

<!-- Modale commandes Details -->

<div id="commande-detail-modal" class="modal-overlay">
    <div class="modal-box modal-box-moyenne">
        <button type="button" class="modal-close" id="commande-detail-close" aria-label="Fermer la fenêtre">&times;
        </button>

        <h1>Details de la commande</h1>

        <div class="commande-detail-content">
            <div class="commande-content">
                <h2 id="commande-detail-numero-commande"></h2>
                <div class="commande-detail">
                    <span>Nom du Menu :</span>
                    <p id="commande-detail-titre-commande"></p>
                    <span>Commande passée le :</span>
                    <p id="commande-detail-date-commande"></p>
                    <span>Date de la prestation :</span>
                    <p id="commande-detail-date-prestation"></p>
                    <span>Heure de la prestation : </span>
                    <p id="commande-detail-heure-prestation"></p>
                    <span>Adresse de livraison :</span>
                    <p id="commande-detail-adresse-livraison"></p>
                    <span>Prêt de matériel :</span>
                    <p id="commande-detail-pret-materiel"></p>
                    <span>Prix total :</span>
                    <p id="commande-detail-prix-total"></p>
                </div>
            </div>
            <div class="info-client-content">
                <h2>Informations client</h2>
                <div class="client-detail">
                    <span>Nom du client :</span>
                    <p id="commande-detail-nom-client"></p>
                    <span>Prénom du client :</span>
                    <p id="commande-detail-prenom-client"></p>
                    <span>Email du client :</span>
                    <p id="commande-detail-email-client"></p>
                    <span> Téléphone du client :</span>
                    <p id="commande-detail-tel-client"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modale annulation commande admin -->

<div class="modal-overlay" id="annulation-modal-admin">
    <div class="modal-box modal-box-moyenne">
        <button type="button" class="modal-close" id="annulation-modal-admin-close" aria-label="Fermer la fenêtre">&times;</button>

        <div class="annulation-content-admin">

            <h2>Annuler la commande</h2>
            <div class="annulation-content-admin-box">
                <span class="annulation-content-titre">Numero de commande :</span>
                <span id="annulation-numero-admin"></span>
                <span class="annulation-content-titre">Date de prestation :</span>
                <span id="annulation-date-prestation-admin"></span>
                <span class="annulation-content-titre">Prix total de la commande :</span>
                <span id="annulation-reglement-admin"></span>
            </div>

            <h2>Mode de contact :</h2>
            <div class="annulation-content-admin-radio">
                <label for="annulation-radio-telephone">Par téléphone :</label>
                <input type="radio" id="annulation-radio-telephone" name="annulation-choice" value="telephone">
                <label for="annulation-radio-sms">Par SMS :</label>
                <input type="radio" id="annulation-radio-sms" name="annulation-choice" value="sms">
                <label for="annulation-radio-email">Par email :</label>
                <input type="radio" id="annulation-radio-email" name="annulation-choice" value="email">
            </div>
            <div class="annulation-content-textarea-box">
                <label for="annulation-content-textarea">Raison de l'annulation :</label>
                <textarea class="annulation-content-textarea" id="annulation-content-textarea" name="annulation_raison" rows="4" cols="15"></textarea>
            </div>
            <div class="btn-annulation-admin-box">
                <button type="button" class="btn-annulation-admin-confirmer" id="btn-annulation-admin-confirmer">
                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                    <span class="text">Confirmer</span>
                    <span class="circle"></span>
                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                </button>
            </div>

            <p id="annulation-erreur" class="erreur"></p>
        </div>
    </div>
</div>

<!-- Modale avis / laissez commentaire -->

<div class="modal-overlay" id="commentaire-modal-user">
    <div class="modal-box modal-box-moyenne">
        <button type="button" class="modal-close" id="commentaire-modal-user-close" aria-label="Fermer la fenêtre">&times;</button>

        <div class="commentaire-content-user">

            <h2>Votre commande :</h2>
            <div class="commentaire-content-user-box">
                <span class="commentaire-content-titre">Numero de commande :</span>
                <span id="commentaire-numero-user" class="commentaire-numero-user"></span>
                <span class="commentaire-content-titre">Date de prestation :</span>
                <span id="commentaire-date-prestation-user" class="commentaire-date-prestation-user"></span>
            </div>

            <h2>Votre avis compte !</h2>
            <div class="commentaire-content-user-radio">
                <span class="fa fa-star star"></span>
                <span class="fa fa-star star"></span>
                <span class="fa fa-star star"></span>
                <span class="fa fa-star star"></span>
                <span class="fa fa-star star"></span>
            </div>
            <span id="star-result">Note : 0/5</span>
            <div class="commentaire-content-textarea-box">
                <label for="commentaire-content-textarea">Laissez nous quelques mots :</label>
                <textarea class="commentaire-content-textarea" id="commentaire-content-textarea" name="commentaire-avis" rows="10" cols="30"></textarea>
            </div>
            <div class="btn-commentaire-user-box">
                <button type="button" class="btn-commentaire-user-confirmer" id="btn-commentaire-user-confirmer">
                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                    <span class="text">Confirmer</span>
                    <span class="circle"></span>
                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                        ></path>
                    </svg>
                </button>
            </div>

            <p id="commentaire-erreur" class="erreur"></p>
        </div>
    </div>
</div>

<footer class="footer-local" role="contentinfo">
    <div class="container-footer">
        <div class="footer-local__main">
            <div class="footer-local__details">
                <h3>Vite & Gourmand</h3>
                <p>
                    343 Avenue des lilas<br>
                    Bordeaux, France 33000
                </p>
                <p>
                    <strong>Téléphone:</strong> <a href="tel:+33123456789">00 11 22 33 44</a><br>
                    <strong>Email:</strong> <a href="mailto:contact@vite-et-gourmand.fr">contact@vite-et-gourmand.fr</a>
                </p>

            </div>
            <div class="footer-local__map">
                <iframe
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1189.374601878703!2d-0.5704800728565587!3d44.84548739799836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd5527e8f751ca81%3A0x796386037b397a89!2sBordeaux!5e0!3m2!1sfr!2sfr!4v1785103915162!5m2!1sfr!2sfr"
                        width="600"
                        height="450"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="strict-origin-when-cross-origin">
                </iframe>
            </div>

        </div>
        <div class="cgv-ml-footer">
            <a href="cgv.php">Conditions générales de vente</a>
            <a href="mentions-legales.php">Mentions légales</a>
            <a href="contact.php">Contact</a>
        </div>
        <div class="footer-local__bottom">
            <p class="footer-local__copyright">&copy; 2026 Vite & Gourmand. All Rights Reserved.</p>
            <nav class="footer-local__social" aria-label="Social media">
                <ul>
                    <li><a href="#" aria-label="Our Facebook Page"><svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Facebook</title><path d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.35C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.732 0 1.325-.593 1.325-1.325V1.325C24 .593 23.407 0 22.675 0z"/></svg></a></li>
                    <li><a href="#" aria-label="Our Instagram Profile"><svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Instagram</title><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.784.297-1.459.717-2.126 1.384S.926 3.356.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.297.784.717 1.459 1.384 2.126.667.666 1.342 1.089 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.784-.297 1.459-.718 2.126-1.384.666-.667 1.089-1.342 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.148-.558-2.913-.297-.784-.718-1.459-1.384-2.126C21.314 1.64 20.64 1.217 19.856.92c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.056 1.17-.249 1.805-.413 2.227-.217.562-.477.96-.896 1.382-.42.419-.819.679-1.381.896-.422.164-1.057.36-2.227.413-1.266.057-1.646.07-4.85.07s-3.585-.015-4.85-.074c-1.17-.056-1.805-.249-2.227-.413-.562-.217-.96-.477-1.382-.896-.419-.42-.679-.819-.896-1.381-.164-.422-.36-1.057-.413-2.227-.057-1.266-.07-1.646-.07-4.85s.015-3.585.074-4.85c.056-1.17.249-1.805.413-2.227.217.562.477.96.896-1.382.42-.419.819.679 1.381-.896.422-.164 1.057.36 2.227-.413 1.266-.057 1.646-.07 4.85-.07zM12 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.88 1.44 1.44 0 000-2.88z"/></svg></a></li>
                </ul>
            </nav>
        </div>
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="assets/js/index-hamb-feature.js"></script>
<script src="assets/js/forms.js"></script>
<script src="assets/js/menus.js"></script>
<script src="assets/js/profil.js"></script>
<script src="assets/js/profil-commandes-employe.js"></script>
<script src="assets/js/profil-commandes-utilisateur.js"></script>
<script src="assets/js/profil-commandes-admin.js"></script>
<script src="assets/js/panier-commande.js"></script>
<script src="assets/js/panier.js"></script>
<script src="assets/js/horaires.js"></script>
<script src="assets/js/fonctions.js"></script>



</div>
</html>