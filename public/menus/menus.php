<?php $css_pages = ['menus']; ?>
<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../src/Config/root-path.php';
require ROOT_PATH . '/src/Views/partials/header.php'; 
?>
<main class="menus-page">
    <!-- SIDEBAR - FILTRES -->
    <aside class="sidebar-menu" id="sidebar-menu">
        <button type="button" class="sidebar-close" id="sidebar-close" aria-label="Fermer les filtres">&times;</button>
        <div class="theme">
            <img src="../assets/images/theme.png" alt="Theme de menu">
            <div class="theme-checkbox">
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="noel" data-theme-id="1">
                        <div class="checkbox-mark"></div>
                        <span>Noël</span>
                    </label>
                </div>
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="pâques" data-theme-id="2">
                        <div class="checkbox-mark"></div>
                        <span>Pâques</span>
                    </label>

                </div>
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="classique" data-theme-id="3">
                        <div class="checkbox-mark"></div>
                        <span>Classique</span>
                    </label>
                </div>
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="evenements" data-theme-id="4">
                        <div class="checkbox-mark"></div>
                        <span>Evenements</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="allergene">
            <img src="../assets/images/allergene.png" alt="Type d'allergene">
            <div class="allergene-checkbox">
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="sans-gluten" data-allergene-id="6">
                        <div class="checkbox-mark"></div>
                        <span>Sans gluten</span>
                    </label>
                </div>
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="sans-lactose" data-allergene-id="4">
                        <div class="checkbox-mark"></div>
                        <span>Sans lactose</span>
                    </label>
                </div>
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="sans-fruits-coque" data-allergene-id="5">
                        <div class="checkbox-mark"></div>
                        <span>Sans fruit à coque</span>
                    </label>
                </div>
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="sans-oeufs" data-allergene-id="1">
                        <div class="checkbox-mark"></div>
                        <span>Sans oeufs</span>
                    </label>
                </div>
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="sans-arachides" data-allergene-id="3">
                        <div class="checkbox-mark"></div>
                        <span>Sans arachides</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="regime">
            <img src="../assets/images/regime.png" alt="Type de régime">
            <div class="regime-checkbox">
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="regime-classique" data-regime-id="1">
                        <div class="checkbox-mark"></div>
                        <span>Classique</span>
                    </label>
                </div>
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="regime-vegetarien" data-regime-id="2">
                        <div class="checkbox-mark"></div>
                        <span>Végétarien</span>
                    </label>
                </div>
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="regime-vegan" data-regime-id="3">
                        <div class="checkbox-mark"></div>
                        <span>Vegan</span>
                    </label>
                </div>
                <div class="theme-individual">
                    <label class="checkbox-custom">
                        <input type="checkbox" id="regime-sans-gluten" data-regime-id="4">
                        <div class="checkbox-mark"></div>
                        <span>Sans gluten</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="nbr-max">
            <img src="../assets/images/nbr-pers-max.png" alt="Nombre maximum de personnes">
            <div class="nbr-personnes-checkbox">
                <div class="theme-individual">
                    <label class="nbr-personnes" for="nbr-personnes"></label>
                    <input type="range" id="nbr-personnes" min="0" max="50" step="5" value="50">
                    <span id="nbr-personnes-valeur">50</span>
                </div>
            </div>
        </div>
        <div class="prix">
            <img src="../assets/images/prix.png" alt="Prix">
            <div class="prix-checkbox">
                <div class="theme-individual">
                    <label class="prix-min" for="prix-min">Prix minimum :</label>
                    <input type="range" id="prix-min" min="0" max="200" step="5" value="0">
                    <span id="prix-min-valeur">0€</span>
                </div>
                <div class="theme-individual">
                    <label class="prix-max" for="prix-max">Prix maximum :</label>
                    <input type="range" id="prix-max" min="0" max="200" step="5" value="200">
                    <span id="prix-max-valeur">200€</span>
                </div>
            </div>
        </div>

        <div class="filtrer-btn-box" id="filter-btn-box">
            <button type="button" class="animated-button" id="reset-filtrer-btn">
                <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                    ></path>
                </svg>
                <span class="text">Reset</span>
                <span class="circle"></span>
                <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                    ></path>
                </svg>
            </button>
            <button type="button" class="animated-button" id="valider-filtrer-btn">
                <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                    ></path>
                </svg>
                <span class="text">Valider</span>
                <span class="circle"></span>
                <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                    ></path>
                </svg>
            </button>
        </div>
    </aside>

    <!-- MENU -->
    <div class="main-menu">
        <div class="menu-titre-resultats">
            <img src="../assets/images/menu-banner.png" alt="Bannière de menu">
            <h2 id="menus-filtre-resultats"></h2>
            <div class="filtre-btn-box">
                <button class="bouton-filtre" id="bouton-filtre">
                    <label for="bouton-filtre">Filtres</label>
                    <img src="../assets/images/filter-solid-full.svg" alt="Filtres">
                </button>
            </div>
        </div>
        <section class="menus-grid">
            <p class="aucun-resultat">Veuillez définir votre recherche à l'aide des filtres, puis cliquer sur "Valider".</p>
        </section>
    </div>
</main>


<?php require ROOT_PATH . '/src/Views/partials/footer.php'; ?>
