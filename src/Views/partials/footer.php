<!--Modale cookies-->
<!--<div id="cookies-modal" class="modal-overlay">-->
<!--    <div class="modal-box modal-box-petite">-->
<!--        <button type="button" class="modal-close" id="cookies-close" aria-label="Fermer la fenêtre">&times;</button>-->
<!---->
<!---->
<!--        logo-->
<!--        continuer sans accepter-->
<!--        titre bienvenue-->
<!--        texte-->
<!---->
<!--        btn refuser et fermer -->
<!--        btn accepter et fermer-->
<!--        <h2>Ooops !</h2>-->
<!--        <p class="erreurs-inscription">-->
<!--            Des erreurs sont survenues.-->
<!--        </p>-->
<!--        <span class="erreurs-inscription-motifs"></span>-->
<!--    </div>-->
<!--</div>-->




<!--modale faire un devis-->
<div id="devis-modal" class="modal-overlay">
    <div class="modal-box">
        <button type="button" class="modal-close" id="devis-close" aria-label="Fermer la fenêtre">&times;</button>

        <form class="form-page" id="devis-form" action="" method="post">
            <img src="/assets/images/devis-banner.png" alt="Banner">
            <p class="form-description">Parlons de votre événement<br>Demandez votre devis traiteur en quelques
                clics.</p>

            <div class="form-nom">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="contact-nom" maxlength="50" pattern="^\b(?:\w|-)+\b$" required>
            </div>

            <div class="form-prenom">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="contact-prenom" maxlength="50" pattern="^\b(?:\w|-)+\b$" required>
            </div>

            <div class="form-tel">
                <label for="tel">Téléphone :</label>
                <input type="tel" inputmode="numeric" id="tel" maxlength="10" pattern="^[0-9]{10}$" name="contact-tel" required>
            </div>

            <div class="form-date">
                <label for="date">Date :</label>
                <input type="date" id="date" name="contact-date" required>
            </div>

            <div class="form-email">
                <label for="email">Email :</label>
                <input type="email" id="email" name="contact-email" maxlength="100" pattern="^[a-z0-9!#$%&'*+\/=?^_`\{\|\}~\-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`\{\|\}~\-]+)*@(?:[a-z0-9](?:[a-z0-9\-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9\-]*[a-z0-9])?$"
                       required>
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

<!--Modale devis confirmation -->
<div id="devis-confirmation" class="modal-overlay">
    <div class="modal-box modal-box-petite">
        <button type="button" class="modal-close" id="confirmation-close"
                aria-label="Fermer la fenêtre">&times;
        </button>
        <h2 class="devis-confirmation-modal-titre">Merci !</h2>
        <p class="devis-confirmation-modal-texte">Votre demande a bien été envoyée. Nous revenons vers vous très vite.</p>
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
            <div class="menu-detail-plats">
                <p>Entrée</p>
                <p>Plat</p>
                <p>Dessert</p>
                <button role="button" class="btn-detail-plats" id="menu-detail-entree-1"></button>
                <button role="button" class="btn-detail-plats" id="menu-detail-plat-1"></button>
                <button role="button" class="btn-detail-plats" id="menu-detail-dessert-1"></button>
                <button role="button" class="btn-detail-plats" id="menu-detail-entree-2"></button>
                <button role="button" class="btn-detail-plats" id="menu-detail-plat-2"></button>
                <button role="button" class="btn-detail-plats" id="menu-detail-dessert-2"></button>
            </div>

            <div class="menu-detail-allergenes-box">
                <i class="fa fa-triangle-exclamation" aria-label="Avertissement allergènes"></i>
                <p id="menu-detail-allergenes"></p>
            </div>

            <p id="menu-detail-stock"></p>
            <p id="menu-detail-prix"></p>


            <div class="menu-detail-quantite">
                <button type="button" class="btn-moins" id="menu-detail-btn-moins" aria-label="Diminuer la quantité">−</button>
                <input type="number" id="menu-detail-input" value="0" min="0" aria-label="Quantité" inputmode="numeric" required>
                <button type="button" class="btn-plus" id="menu-detail-btn-plus" aria-label="Augmenter la quantité">+</button>
            </div>
            <p id="menu-detail-personne-minimum"></p>

            <p id="menu-detail-prix-calcule"></p>

            <p id="menu-detail-condition"></p>

            <p id="menu-detail-reduc">✓ Réduction de 10% appliquée
                si +5 personnes au-dessus du minimum</p>
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

<!-- Modale images plats -->
<div id="menu-detail-img-modal" class="modal-overlay">
    <div class="modal-box modal-box-moyenne-detail-img">
        <button type="button" class="modal-close" id="menu-detail-img-close" aria-label="Fermer la fenêtre">&times;</button>

        <p class="menu-detail-titre-img"></p>
        <p class="menu-detail-description-img"></p>
        <img id="menu-detail-img-modal-img" src="" alt="">
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

            <div class="annulation-content-textarea-box">
                <label for="annulation-utilisateur-content-textarea">Raison de l'annulation :</label>
                <textarea class="annulation-content-textarea" id="annulation-utilisateur-content-textarea" name="annulation_raison" rows="4" cols="15"></textarea>
            </div>

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
            <p id="annulation-erreur-utilisateur" class="erreur"></p>
        </div>
    </div>
</div>


<!-- Modale Panier confirmation -->
<div id="panier-confirmation-modal" class="modal-overlay">
    <div class="modal-box modal-box-petite">
        <button type="button" class="modal-close" id="panier-confirmation-close" aria-label="Fermer la fenêtre">&times;</button>

        <h2>Menu ajouté au panier ✓</h2>

        <div class="btn-panier-confirm-box">
            <a href="/panier/mon-panier.php" class="animated-button" id="btn-voir-panier">
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

            <p id="annulation-erreur-admin" class="erreur"></p>
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
                <button type="button" class="fa fa-star star" aria-label="1 étoile"></button>
                <button type="button" class="fa fa-star star" aria-label="2 étoiles"></button>
                <button type="button" class="fa fa-star star" aria-label="3 étoiles"></button>
                <button type="button" class="fa fa-star star" aria-label="4 étoiles"></button>
                <button type="button" class="fa fa-star star" aria-label="5 étoiles"></button>
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
                    <strong>Téléphone :</strong> <a href="tel:+33123456789">00 11 22 33 44</a><br>
                    <strong>Email :</strong> <a href="mailto:contact@vite-et-gourmand.fr">contact@vite-et-gourmand.fr</a>
                </p>

            </div>
            <div class="footer-local__map">
                <script>(tarteaucitron.job = tarteaucitron.job || []).push('maps_noapi');</script>
                <div class="googlemaps_embed"
                     data-width="600"
                     data-height="450"
                     id="!1m18!1m12!1m3!1d1189.374601878703!2d-0.5704800728565587!3d44.84548739799836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd5527e8f751ca81%3A0x796386037b397a89!2sBordeaux!5e0!3m2!1sfr!2sfr!4v1785103915162!5m2!1sfr!2sfr">
                </div>
            </div>

        </div>
        <div class="cgv-ml-footer">
            <a href="/legal/cgv.php">Conditions générales de vente</a>
            <a href="/legal/mentions-legales.php">Mentions légales</a>
            <a href="/contact/contact.php">Contact</a>
        </div>
        <div class="footer-local__bottom">
            <p class="footer-local__copyright">&copy; 2026 Vite & Gourmand. All Rights Reserved.</p>
            <nav class="footer-local__social" aria-label="Social media">
                <ul>
                    <li><a href="#" aria-label="Our Facebook Page"><svg viewBox="0 0 24 24" class="arr-1" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg"><title>Facebook</title><path d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.35C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.732 0 1.325-.593 1.325-1.325V1.325C24 .593 23.407 0 22.675 0z"/></svg></a></li>
                    <li><a href="#" aria-label="Our Instagram Profile"><svg viewBox="0 0 24 24" class="arr-1" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg"><title>Instagram</title><path d="M7.0301.084c-1.2768.0602-2.1487.264-2.911.5634-.7888.3075-1.4575.72-2.1228 1.3877-.6652.6677-1.075 1.3368-1.3802 2.127-.2954.7638-.4956 1.6365-.552 2.914-.0564 1.2775-.0689 1.6882-.0626 4.947.0062 3.2586.0206 3.6671.0825 4.9473.061 1.2765.264 2.1482.5635 2.9107.308.7889.72 1.4573 1.388 2.1228.6679.6655 1.3365 1.0743 2.1285 1.38.7632.295 1.6361.4961 2.9134.552 1.2773.056 1.6884.069 4.9462.0627 3.2578-.0062 3.668-.0207 4.9478-.0814 1.28-.0607 2.147-.2652 2.9098-.5633.7889-.3086 1.4578-.72 2.1228-1.3881.665-.6682 1.0745-1.3378 1.3795-2.1284.2957-.7632.4966-1.636.552-2.9124.056-1.2809.0692-1.6898.063-4.948-.0063-3.2583-.021-3.6668-.0817-4.9465-.0607-1.2797-.264-2.1487-.5633-2.9117-.3084-.7889-.72-1.4568-1.3876-2.1228C21.2982 1.33 20.628.9208 19.8378.6165 19.074.321 18.2017.1197 16.9244.0645 15.6471.0093 15.236-.005 11.977.0014 8.718.0076 8.31.0215 7.0301.0839m.1402 21.6932c-1.17-.0509-1.8053-.2453-2.2287-.408-.5606-.216-.96-.4771-1.3819-.895-.422-.4178-.6811-.8186-.9-1.378-.1644-.4234-.3624-1.058-.4171-2.228-.0595-1.2645-.072-1.6442-.079-4.848-.007-3.2037.0053-3.583.0607-4.848.05-1.169.2456-1.805.408-2.2282.216-.5613.4762-.96.895-1.3816.4188-.4217.8184-.6814 1.3783-.9003.423-.1651 1.0575-.3614 2.227-.4171 1.2655-.06 1.6447-.072 4.848-.079 3.2033-.007 3.5835.005 4.8495.0608 1.169.0508 1.8053.2445 2.228.408.5608.216.96.4754 1.3816.895.4217.4194.6816.8176.9005 1.3787.1653.4217.3617 1.056.4169 2.2263.0602 1.2655.0739 1.645.0796 4.848.0058 3.203-.0055 3.5834-.061 4.848-.051 1.17-.245 1.8055-.408 2.2294-.216.5604-.4763.96-.8954 1.3814-.419.4215-.8181.6811-1.3783.9-.4224.1649-1.0577.3617-2.2262.4174-1.2656.0595-1.6448.072-4.8493.079-3.2045.007-3.5825-.006-4.848-.0608M16.953 5.5864A1.44 1.44 0 1 0 18.39 4.144a1.44 1.44 0 0 0-1.437 1.4424M5.8385 12.012c.0067 3.4032 2.7706 6.1557 6.173 6.1493 3.4026-.0065 6.157-2.7701 6.1506-6.1733-.0065-3.4032-2.771-6.1565-6.174-6.1498-3.403.0067-6.156 2.771-6.1496 6.1738M8 12.0077a4 4 0 1 1 4.008 3.9921A3.9996 3.9996 0 0 1 8 12.0077"/></svg></a></li>
                </ul>
            </nav>
        </div>
    </div>
</footer>

<script src="/assets/js/fonctions.js"></script>
<script src="/assets/js/index-hamb-feature.js"></script>
<script src="/assets/js/forms.js"></script>
<script src="/assets/js/menus.js"></script>
<script src="/assets/js/profil.js"></script>
<script src="/assets/js/profil-commandes-employe.js"></script>
<script src="/assets/js/profil-commandes-utilisateur.js"></script>
<script src="/assets/js/profil-commandes-admin.js"></script>
<script src="/assets/js/panier-commande.js"></script>
<script src="/assets/js/panier.js"></script>
<script src="/assets/js/horaires.js"></script>
<script src="/assets/js/profil-statistiques-admin.js"></script>

</div>
</html>
