<?php require 'includes/header.php'; ?>

<main>
    <section class="commande">
        <div class="commande-top-img">
            <img src="assets/images/reserver-prestation.png" alt="Réserver une prestation">
        </div>
        <div class="commande-box">
            <div class="commande-box-1">
                <div class="titre-info-perso">
                    <img src="assets/images/info-client.png" alt="Informations client">
                </div>
                <div class="first-ligne-info">
                    <div class="infos-perso">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" placeholder="Votre Nom">
                    </div>
                    <div class="infos-perso">
                        <label for="prénom">Prénom</label>
                        <input type="text" id="prénom" placeholder="Votre Prénom">
                    </div>
                </div>
                <div class="second-ligne-info">
                    <div class="infos-perso">
                        <label for="email">Email</label>
                        <input type="email" id="email" placeholder="Votre Email">
                    </div>
                    <div class="infos-perso">
                        <label for="téléphone">Téléphone</label>
                        <input type="tel" id="téléphone" placeholder="Votre Téléphone">
                    </div>
                </div>
                <div class="third-ligne-info">
                    <select id="adresse-select">
                        <option value="">Choisir une adresse enregistrée</option>
                    </select>
                </div>
                <div class="new-adresse">
                    <a href="new_adresse.php">+ Saisir une nouvelle adresse</a>
                </div>
                <div class="fourth-ligne-info">
                    <div class="infos-perso-date-heure">
                        <label for="date-heure">Date et heure de la prestation</label>
                        <input type="datetime-local" id="date-heure">
                    </div>
                </div>
            </div>
            <div class="commande-box-2">
                <div class="titre-choix-menu">
                    <img src="assets/images/votre-menu.png" alt="Votre menu">
                </div>
                <div class="first-ligne-choix-menu">
                    <select id="choix-menu">
                        <option value="">Sélectionnez votre menu</option>
                    </select>
                </div>
                <div class="second-ligne-choix-menu">
                    <div class="infos-menu">
                        <label for="nbr-personnes">Nombre de personnes</label>
                        <input type="number" id="nbr-personnes" placeholder="Nombre de personnes">
                        <p class="explications-nbr-pers">Minimum : 10 personnes<br>
                            (selon le menu selectionné)</p>
                    </div>
                    <div class="location-materiel">
                        <label class="checkbox-custom">
                            <input type="checkbox" id="matériel">
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
                <div class="titre-recap-commande">
                    <img src="assets/images/recap.png" alt="Récapitulatif de la commande">
                </div>
                <div class="recap-commande-box">
                    <div class="recap-infos">
                        <p>Menu : xxx</p>
                        <p>Nombre de personnes : xxx</p>
                        <p>Adresse : xxx</p>
                        <p>Date de livraison : le xxx à xxhxx</p>
                        <p>Forfait location de matériel : y/n</p>
                        <p>Prix de la livraison : xx€</p>
                    </div>
                    <div class="recap-prix">
                        <p>Total : xxx€</p>
                    </div>
                </div>
                <div class="recap-commande-bouton-confirmation">
                    <button type="button" id="confirmation" class="bouton-confirmation">Confirmer la commande</button>
                    <p>Un mail de confirmation vous sera envoyé après validation de la commande</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require 'includes/footer.php'; ?>
