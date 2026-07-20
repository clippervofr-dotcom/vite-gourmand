<?php $css_pages = ['menus']; ?>
<?php require 'includes/header.php'; ?>
<div class="menus-page">
    <!-- SIDEBAR - FILTRES -->
    <aside class="sidebar-menu" id="sidebar-menu">
        <button type="button" class="sidebar-close" id="sidebar-close" aria-label="Fermer les filtres">&times;</button>
        <div class="theme">
            <img src="assets/images/theme.png" alt="Theme de menu">
            <div class="theme-checkbox">
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="noel">
                        <div class="checkbox-mark"></div>
                        <span>Noël</span>
                    </label>
                </div>
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="pâques">
                        <div class="checkbox-mark"></div>
                        <span>Pâques</span>
                    </label>

                </div>
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="classique">
                        <div class="checkbox-mark"></div>
                        <span>Classique</span>
                    </label>
                </div>
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="evenements">
                        <div class="checkbox-mark"></div>
                        <span>Evenements</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="allergene">
            <img src="assets/images/allergene.png" alt="Type d'allergene">
            <div class="theme-checkbox">
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="sans-gluten">
                        <div class="checkbox-mark"></div>
                        <span>Sans gluten</span>
                    </label>
                </div>
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="sans-lactose">
                        <div class="checkbox-mark"></div>
                        <span>Sans lactose</span>
                    </label>
                </div>
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="sans-fruits-coque">
                        <div class="checkbox-mark"></div>
                        <span>Sans fruit à coque</span>
                    </label>
                </div>
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="sans-oeufs">
                        <div class="checkbox-mark"></div>
                        <span>Sans oeufs</span>
                    </label>
                </div>
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="sans-arachides">
                        <div class="checkbox-mark"></div>
                        <span>Sans arachides</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="theme">
            <img src="assets/images/regime.png" alt="Type de régime">
            <div class="theme-checkbox">
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="regime-classique">
                        <div class="checkbox-mark"></div>
                        <span>Classique</span>
                    </label>
                </div>
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="regime-vegetarien">
                        <div class="checkbox-mark"></div>
                        <span>Végétarien</span>
                    </label>
                </div>
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="regime-vegan">
                        <div class="checkbox-mark"></div>
                        <span>Vegan</span>
                    </label>
                </div>
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="regime-sans-gluten">
                        <div class="checkbox-mark"></div>
                        <span>Sans gluten</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="nbr-max">
            <img src="assets/images/nbr-pers-max.png" alt="Nombre maximum de personnes">
            <div class="theme-checkbox">
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="nbr-pers-inf-10">
                        <div class="checkbox-mark"></div>
                        <span>Inférieur à 10</span>
                    </label>
                </div>
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="nbr-pers-10-20">
                        <div class="checkbox-mark"></div>
                        <span>Entre 10 et 20</span>
                    </label>
                </div>
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="nbr-pers-sup-30">
                        <div class="checkbox-mark"></div>
                        <span>Supérieur à 30</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="theme">
            <img src="assets/images/prix.png" alt="Prix">
            <div class="theme-checkbox">
                <div class="theme-individual">
                    <label class="prix" for="prix-min">Prix minimum :</label>
                    <input type="range" id="prix-min" min="0" max="200" step="5" value="0">
                    <span>0€</span>
                </div>
                <div class="theme-individual">
                    <label class="prix" for="prix-max">Prix maximum :</label>
                    <input type="range" id="prix-max" min="0" max="200" step="5" value="200">
                    <span>200€</span>
                </div>
            </div>
        </div>

        <div class="filtrer-btn-box" id="filter-btn-box">
            <button type="button" id="reset-filtrer-btn">Reset</button>
            <button type="button" id="filtrer-btn">Valider</button>
        </div>
    </aside>

    <!-- MENU -->
    <main class="main-menu">
        <div class="menu-titre-resultats">
            <img src="assets/images/menu-banner.png" alt="Bannière de menu">
            <h2>X Résultats</h2>
            <div class="filtre-btn-box">
                <button class="bouton-filtre" id="bouton-filtre">
                    <img src="assets/images/filtre.png" alt="Filtrer">
                </button>
            </div>

        </div>
        <section class="menus-grid">
            <div class="menus-box">
                <img src="assets/images/noel.png" alt="Menu de noel">
                <div class="menus-box-titre-visible">
                    <h3>Menu de noël</h3>
                    <div class="menus-voir-detail-bouton">
                        <button type="button" class="bouton-voir-detail" data-menu-id="1">Voir le detail</button>
                    </div>
                </div>
            </div>
            <div class="menus-box">
                <img src="assets/images/paques.png" alt="Menu de paques">
                <div class="menus-box-titre-visible">
                    <h3>Menu de Pâques</h3>
                    <div class="menus-voir-detail-bouton">
                        <button type="button" class="bouton-voir-detail" data-menu-id="2">Voir le detail</button>
                    </div>
                </div>
            </div>
            <div class="menus-box">
                <img src="assets/images/classique.png" alt="Menu Classique">
                <div class="menus-box-titre-visible">
                    <h3>Menu Classique</h3>
                    <div class="menus-voir-detail-bouton">
                        <button type="button" class="bouton-voir-detail" data-menu-id="3">Voir le detail</button>
                    </div>
                </div>
            </div>
            <div class="menus-box">
                <img src="assets/images/vege3.png" alt="Menu végétarien">
                <div class="menus-box-titre-visible">
                    <h3>Menu végétarien</h3>
                    <div class="menus-voir-detail-bouton">
                        <button type="button" class="bouton-voir-detail" data-menu-id="5">Voir le detail</button>
                    </div>
                </div>
            </div>
            <div class="menus-box">
                <img src="assets/images/evenement2.png" alt="Menu de noel">
                <div class="menus-box-titre-visible">
                    <h3>Menu Evenementiel</h3>
                    <div class="menus-voir-detail-bouton">
                        <button type="button" class="bouton-voir-detail" data-menu-id="4">Voir le detail</button>
                    </div>
                </div>
            </div>
            <a href="commande.php" class="bouton-commander">Commander</a>
        </section>
    </main>
</div>


<?php require 'includes/footer.php'; ?>
