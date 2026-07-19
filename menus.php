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
                        <a href="menus.detail.php" class="bouton-voir-detail">Voir le detail</a>
                    </div>
                </div>
                <!-- futur Clic JS
                <div class="menus-box-texte">
                    <h3>Menu de Noël</h3>
                    <p>Découvrez notre Menu de Noël, une sélection de plats festifs préparés avec des ingrédients de qualité pour partager un moment gourmand et chaleureux en famille ou entre amis.</p>
                    <p>30€ / pers. (10 pers. min)</p>
                    <p class="stock">Stock : 50 disponibles</p>
                    <div class="quantite">
                        <div class="bouton-moins">
                            <img src="assets/images/moins.png" alt="bouton moins">
                        </div>
                        <input type="number" value="0" min="0" id="quantite" class="quantite-input">
                        <div class="bouton-plus">
                            <img src="assets/images/plus.png" alt="bouton plus">
                        </div>
                    </div>
                    <p class="reduc">✓ Réduction de 10% appliquée<br>
                        si +5 personnes au-dessus du minimum</p>
                </div>
                -->
            </div>
            <div class="menus-box">
                <img src="assets/images/paques.png" alt="Menu de paques">
                <div class="menus-box-titre-visible">
                    <h3>Menu de Pâques</h3>
                    <div class="menus-voir-detail-bouton">
                        <a href="menus.detail.php" class="bouton-voir-detail">Voir le detail</a>
                    </div>
                </div>
                <!-- futur Clic JS
                <div class="menus-box-texte">
                    <h3>Menu de Pâques</h3>
                    <p>Une chasse aux œufs, c'est bien. Une chasse aux bons plats, c'est mieux !</p>
                    <p>Savourez notre Menu de Pâques, une sélection de plats de saison aux saveurs printanières, idéale pour célébrer ce moment de convivialité.</p>
                    <p>20€ / pers. (20 pers. min)</p>
                    <p class="stock">Stock : 30 disponibles</p>
                    <p class="reduc">✓ Réduction de 10% appliquée<br>
                        si +5 personnes au-dessus du minimum</p>
                </div>
                -->
            </div>
            <div class="menus-box">
                <img src="assets/images/classique.png" alt="Menu Classique">
                <div class="menus-box-titre-visible">
                    <h3>Menu Classique</h3>
                    <div class="menus-voir-detail-bouton">
                        <a href="menus.detail.php" class="bouton-voir-detail">Voir le detail</a>
                    </div>
                </div>
                <!-- futur Clic JS
                <div class="menus-box-texte">
                    <h3>Menu Classique</h3>
                    <p>Découvrez notre Menu Classique, une sélection de plats traditionnels préparés avec des ingrédients de qualité pour partager un moment gourmand et chaleureux en famille ou entre amis.</p>
                    <p>25€ / pers. (10 pers. min)</p>
                    <p class="stock">Stock épuisé</p>
                    <p class="reduc">✓ Réduction de 10% appliquée<br>
                        si +5 personnes au-dessus du minimum</p>
                </div>
                -->
            </div>
            <div class="menus-box">
                <img src="assets/images/vege3.png" alt="Menu végétarien">
                <div class="menus-box-titre-visible">
                    <h3>Menu végétarien</h3>
                    <div class="menus-voir-detail-bouton">
                        <a href="menus.detail.php" class="bouton-voir-detail">Voir le detail</a>
                    </div>
                </div>
                <!-- futur Clic JS
                <div class="menus-box-texte">
                    <h3>Menu végétarien</h3>
                    <p>Découvrez notre Menu végétarien, une sélection de plats savoureux préparés avec des ingrédients de qualité pour partager un moment gourmand et chaleureux en famille ou entre amis.</p>
                    <p>5€ / pers. (20 pers. min)</p>
                    <p class="stock">Stock : 100 disponibles</p>
                    <p class="reduc">✓ Réduction de 10% appliquée<br>
                        si +5 personnes au-dessus du minimum</p>
                </div>
                -->
            </div>
            <div class="menus-box">
                <img src="assets/images/evenement2.png" alt="Menu de noel">
                <div class="menus-box-titre-visible">
                    <h3>Menu Evenementiel</h3>
                    <div class="menus-voir-detail-bouton">
                        <a href="menus.detail.php" class="bouton-voir-detail">Voir le detail</a>
                    </div>
                </div>
                <!-- futur Clic JS
                <div class="menus-box-texte">
                    <h3>Menu Evenementiel</h3>
                    <p>Découvrez notre Menu Evenementiel, une sélection de plats festifs préparés avec des ingrédients de qualité pour partager un moment gourmand et chaleureux en famille ou entre amis.</p>
                    <p>50€ / pers. (30 pers. min)</p>
                    <p class="stock">Stock : 100 disponibles</p>
                    <p class="reduc">✓ Réduction de 10% appliquée<br>
                        si +5 personnes au-dessus du minimum</p>
                </div>
                -->
            </div>
            <a href="commande.php" class="bouton-commander">Commander</a>
        </section>
    </main>
</div>


<?php require 'includes/footer.php'; ?>
