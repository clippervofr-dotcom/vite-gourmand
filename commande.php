<?php
session_start();

if (!isset($_SESSION['utilisateur'])) {
    header('Location: connexion.php');
    exit;
}
?>


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
                        <input type="text" id="nom-commande" maxlength="50" pattern="/^\\b(?:\\w|-)+\\b$/" placeholder="Votre Nom" name="nom-commande" required>
                    </div>
                    <div class="infos-perso">
                        <label for="prenom-commande">Prénom<span class="requis" aria-hidden="true">*</span></label>
                        <input type="text" id="prenom-commande" maxlength="50" pattern="/^\\b(?:\\w|-)+\\b$/" placeholder="Votre Prénom" name="prenom-commande" required>
                    </div>
                </div>
                <div class="second-ligne-info">
                    <div class="infos-perso">
                        <label for="email-commande">Email<span class="requis" aria-hidden="true">*</span></label>
                        <input type="email" id="email-commande" maxlength="100" pattern="^[a-z0-9!#$%&'*+\/=?^_`\{\|\}~\-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`\{\|\}~\-]+)*@(?:[a-z0-9](?:[a-z0-9\-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9\-]*[a-z0-9])?$" placeholder="Votre Email" name="email-commande" required>
                    </div>
                    <div class="infos-perso">
                        <label for="telephone-commande">Téléphone<span class="requis" aria-hidden="true">*</span></label>
                        <input type="tel" id="telephone-commande" maxlength="10" placeholder="Votre Téléphone" pattern="^[0-9]{10}$" name="telephone-commande" required>
                    </div>
                </div>
                <div class="third-ligne-info">
                    <div class="infos-perso">
                        <label for="adresse-commande">Adresse<span class="requis" aria-hidden="true">*</span></label>
                        <input type="text" id="adresse-commande" maxlength="150" placeholder="Votre Adresse" name="adresse-commande" required>
                    </div>
                </div>
                <div class="first-ligne-info">
                    <div class="infos-perso">
                        <label for="code-postal-commande">Code Postal<span class="requis" aria-hidden="true">*</span></label>
                        <input type="number" inputmode="numeric" pattern="^[0-9]{5}$" maxlength="5" id="code-postal-commande" placeholder="Votre Code Postal" name="code-postal-commande" required>
                    </div>
                    <div class="infos-perso">
                        <label for="ville-commande">Ville<span class="requis" aria-hidden="true">*</span></label>
                        <input type="text" id="ville-commande" maxlength="50" pattern="/^\\b(?:\\w|-)+\\b$/" placeholder="Votre Ville" name="ville-commande" required>
                    </div>
                </div>
                <div class="fourth-ligne-info">
                    <div class="infos-perso-date-heure">
                        <label for="date-heure">Date et heure de la prestation<span class="requis" aria-hidden="true">*</span></label>
                        <input type="datetime-local" data-date="date livraison" id="date-heure" name="date-heure">
                    </div>
                </div>
            </div>
            <div class="commande-box-2">
                <span class="bubulle">2</span>
                <div class="titre-choix-menu">
                    <img src="assets/images/votre-menu.png" alt="Votre menu">
                </div>
                <div class="third-ligne-info">
                    <div class="infos-perso">
                        <label for="choix-menu">Choix du menu</label>
                        <input type="text" id="choix-menu">
                    </div>
                </div>
                <div class="second-ligne-choix-menu">
                    <div class="infos-menu">
                        <label for="nbr-personnes-commande" class="nbr">Nombre de personnes</label>
                        <input type="number" id="nbr-personnes-commande" placeholder="Nombre de personnes" name="nbr-personnes-commande">
                        <p class="explications-nbr-pers">Minimum : 10 personnes<br>
                            (selon le menu selectionné)</p>
                    </div>
                    <div class="location-materiel">
                        <label class="checkbox-custom" id="checkbox-location">
                            <input type="checkbox" data-location="99" id="materiel" name="matériel">
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
                <!-- JS recap ICI -->
            </div>
        </div>
        <div>
            <img src="assets/images/banniere-v&g.png" class="bottom-banner" alt="Banniere Vite & Gourmand">
        </div>
    </form>
</main>

<?php require 'includes/footer.php'; ?>
