<?php $css_pages = ['forms']; ?>
<?php require 'includes/header.php'; ?>

<main>
    <form class="commande" action="" method="post">
        <div class="commande-top-img">
            <img src="assets/images/reserver-prestation.png" alt="Réserver une prestation">
        </div>
        <div class="commande-box">
            <div class="commande-box-1">
                <span class="bubulle">1</span>
                <div class="titre-info-perso">
                    <img src="assets/images/info-client.png" alt="Informations client">
                </div>
                <div class="first-ligne-info">
                    <div class="infos-perso">
                        <label for="nom-commande">Nom<span class="requis" aria-hidden="true">*</span></label>
                        <input type="text" id="nom-commande" placeholder="Votre Nom" name="nom-commande" required>
                    </div>
                    <div class="infos-perso">
                        <label for="prénom-commande">Prénom<span class="requis" aria-hidden="true">*</span></label>
                        <input type="text" id="prénom-commande" placeholder="Votre Prénom" name="prénom-commande" required>
                    </div>
                </div>
                <div class="second-ligne-info">
                    <div class="infos-perso">
                        <label for="email-commande">Email<span class="requis" aria-hidden="true">*</span></label>
                        <input type="email" id="email-commande" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Votre Email" name="email-commande" required>
                    </div>
                    <div class="infos-perso">
                        <label for="téléphone-commande">Téléphone<span class="requis" aria-hidden="true">*</span></label>
                        <input type="tel" id="téléphone-commande" placeholder="Votre Téléphone" name="téléphone-commande" required>
                    </div>
                </div>
                <div class="third-ligne-info">
                    <div class="infos-perso">
                        <label for="adresse-commande">Adresse<span class="requis" aria-hidden="true">*</span></label>
                        <input type="text" id="adresse-commande" placeholder="Votre Adresse" name="adresse-commande" required>
                    </div>
                </div>
                <div class="first-ligne-info">
                    <div class="infos-perso">
                        <label for="code-postal-commande">Code Postal<span class="requis" aria-hidden="true">*</span></label>
                        <input type="number" inputmode="numeric" pattern="[0-9]{5}" maxlength="5" id="code-postal-commande" placeholder="Votre Code Postal" name="code-postal-commande" required>
                    </div>
                    <div class="infos-perso">
                        <label for="ville-commande">Ville<span class="requis" aria-hidden="true">*</span></label>
                        <input type="text" id="ville-commande" placeholder="Votre Ville" name="ville-commande" required>
                    </div>
                </div>


                <div class="fourth-ligne-info">
                    <div class="infos-perso-date-heure">
                        <label for="date-heure">Date et heure de la prestation<span class="requis" aria-hidden="true">*</span></label>
                        <input type="datetime-local" id="date-heure" name="date-heure">
                    </div>
                </div>
            </div>
            <div class="commande-box-2">
                <span class="bubulle">2</span>
                <div class="titre-choix-menu">
                    <img src="assets/images/votre-menu.png" alt="Votre menu">
                </div>
                <div class="first-ligne-choix-menu">
                    <label for="choix-menu">Menu<span class="requis" aria-hidden="true">*</span></label>
                    <select id="choix-menu" name="choix-menu">
                        <option value="" selected>Sélectionnez votre menu</option>
                        <option value="menu-noel" data-menu-id="1">Menu de Noël</option>
                        <option value="menu-paques" data-menu-id="2">Menu de Pâques</option>
                        <option value="menu-classique" data-menu-id="3">Menu Classique</option>
                        <option value="menu-vegetarien" data-menu-id="4">Menu Événementiel</option>
                        <option value="menu-evenementiel" data-menu-id="5">Menu Végétarien</option>
                    </select>
                </div>
                <div class="second-ligne-choix-menu">
                    <div class="infos-menu">
                        <label for="nbr-personnes-commande" class="nbr">Nombre de personnes<span class="requis">*</span></label>
                        <input type="number" id="nbr-personnes-commande" placeholder="Nombre de personnes" name="nbr-personnes-commande">
                        <p class="explications-nbr-pers">Minimum : 10 personnes<br>
                            (selon le menu selectionné)</p>
                    </div>
                    <div class="location-materiel">
                        <label class="checkbox-custom" id="checkbox-location">
                            <input type="checkbox" id="matériel" name="matériel">
                            <div class="checkbox-mark"></div>
                            <span>Je souhaite louer du matériel</span>
                        </label>
                        <div class="explications-location-materiel-forfait">
                            <p>Forfait matériel : 99€</p>
                            <p>Sur devis pour les événements de +50 personnes</p>
                            <p class="explications-location-materiel">(Tables, chaises, supports de présentation, matériel de buffet et<br>
                                équipements de réception selon les besoins<br>
                                de votre événement.)</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="commande-box-3">
                <span class="bubulle">3</span>
                <div class="titre-recap-commande">
                    <img src="assets/images/recap.png" alt="Récapitulatif de la commande">
                </div>
                <div class="recap-commande-box">
                    <div class="recap-infos">
                        <div class="recap-liste">
                            <p class="recap-intitule">Menu :</p>
                            <p class="recap-resultat">xxxx</p>
                        </div>
                        <div class="recap-liste">
                            <p class="recap-intitule">Nombre de personnes :</p>
                            <p class="recap-resultat">xxxx</p>
                        </div>
                        <div class="recap-liste">
                            <p class="recap-intitule">Adresse :</p>
                            <p class="recap-resultat">xxxx</p>
                        </div>
                        <div class="recap-liste">
                            <p class="recap-intitule">Date de livraison :</p>
                            <p class="recap-resultat"> le xxx à xxhxx</p>
                        </div>
                        <div class="recap-liste">
                            <p class="recap-intitule">Forfait location de matériel :</p>
                            <p class="recap-resultat"> y/n</p>
                        </div>
                        <div class="recap-liste">
                            <p class="recap-intitule">Prix de la livraison :</p>
                            <p class="recap-resultat"> xx€</p>
                        </div>
                    </div>
                    <div class="recap-prix">
                        <p>Total : xxx€</p>
                    </div>
                </div>
                <div class="recap-commande-bouton-confirmation">
                    <button class="animated-button" type="button" id="btn-confirmation-commande">
                        <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                            ></path>
                        </svg>
                        <span class="text">Confirmer la commande</span>
                        <span class="circle"></span>
                        <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                            ></path>
                        </svg>
                    </button>
                    <p>Un mail de confirmation vous sera envoyé après validation de la commande</p>
                </div>
            </div>
        </div>
        <div>
            <img src="assets/images/banniere-v&g.png" class="bottom-banner" alt="Banniere Vite & Gourmand">
        </div>
    </form>
</main>

<?php require 'includes/footer.php'; ?>
