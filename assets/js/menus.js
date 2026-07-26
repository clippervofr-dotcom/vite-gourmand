const sidebarMenu = document.querySelector("#sidebar-menu");
const btnFiltre = document.querySelector("#bouton-filtre");
const sidebarClosebtn = document.querySelector("#sidebar-close");

if (sidebarMenu && btnFiltre) {
    btnFiltre.addEventListener('click', function () {
        sidebarMenu.classList.toggle('active')
    });

    document.addEventListener(('keydown'), function (event) {
        if (event.key === 'Escape') {
            sidebarMenu.classList.remove('active')
        }
    });

    sidebarClosebtn.addEventListener('click', function () {
        sidebarMenu.classList.remove('active')
    });

    document.addEventListener('click', function (event) {
        const clicDansSidebar = sidebarMenu.contains(event.target);
        const clicSurBouton = btnFiltre.contains(event.target);

        if (sidebarMenu.classList.contains('active') && !clicDansSidebar && !clicSurBouton) {
            sidebarMenu.classList.remove('active');
        }
    });
}

const filtrerBtnbox = document.querySelector("#valider-filtrer-btn");

if (filtrerBtnbox) {
    filtrerBtnbox.addEventListener('click', function () {
        sidebarMenu.classList.remove('active');
    });
}

const menuDetailmodal = document.querySelector("#menu-detail-modal");
const btnMenuClose = document.querySelector("#menu-detail-close");
const inputQuantite = document.querySelector("#menu-detail-input");

const menusData = {
    1: { titre: "Menu de Noël",
        description: "Des saveurs si festives que même le Père Noël risque d'oublier sa tournée !",
        prixUnitaire: 30,
        stock: 50,
        image: "assets/images/noel.png",
        reduc: "✓ Réduction de 10% appliquée\n si +5 personnes au-dessus du minimum",
        value: 10,
        min: 10,
    },
    2: { titre: "Menu de Pâques",
        description: "Une chasse aux œufs, c'est bien. Une chasse aux bons plats, c'est mieux !",
        prixUnitaire: 25,
        stock: 30,
        image: "assets/images/paques.png",
        reduc: "✓ Réduction de 10% appliquée\n si +5 personnes au-dessus du minimum",
        value: 10,
        min: 10,
    },
    3: { titre: "Menu Classique",
        description: "Les grands classiques : parce qu'on ne change pas une équipe qui régale.",
        prixUnitaire: 20,
        stock: 0,
        image: "assets/images/classique.png",
        reduc: "✓ Réduction de 10% appliquée\n si +5 personnes au-dessus du minimum",
        value: 20,
        min: 20,
    },
    4: { titre: "Menu Événementiel",
        description: "Pour vos grands moments : on s'occupe du festin, vous récoltez les compliments.",
        prixUnitaire: 50,
        stock: 100,
        image: "assets/images/evenement2.png",
        reduc: "✓ Réduction de 10% appliquée\n si +5 personnes au-dessus du minimum",
        value: 30,
        min: 30,
    },
    5: { titre: "Menu Végétarien",
        description: "La preuve qu'un repas peut être complet sans avoir rencontré une vache.",
        prixUnitaire: 5,
        stock: 100,
        image: "assets/images/vege3.png",
        reduc: "✓ Réduction de 10% appliquée\n si +5 personnes au-dessus du minimum",
        value: 20,
        min: 20,
    }
};


if (menuDetailmodal && btnMenuClose) {
    function remplirModaleMenu(menuId) {
        const menu = menusData[menuId];
        if (!menu) return;

        document.querySelector("#menu-detail-titre").textContent = menu['titre'];
        document.querySelector("#menu-detail-description").textContent = menu['description'];
        document.querySelector("#menu-detail-prix").textContent = `${menu['prixUnitaire']}€ / pers. (${menu['value']} pers. min)`;

        let texteStock;
        if (menu['stock'] === undefined) {
            texteStock = "Stock non renseigné";
        } else if (menu['stock'] === 0) {
            texteStock = "Stock épuisé";
            document.querySelector("#menu-detail-stock").style.color = "var(--couleur-police-epuise)";
        } else {
            texteStock = `Stock : ${menu['stock']} disponibles`;
            document.querySelector("#menu-detail-stock").style.color = "var(--couleur-police-stock)";
        }
        document.querySelector("#menu-detail-stock").textContent = texteStock;

        document.querySelector("#menu-detail-reduc").textContent = menu['reduc'] || '';
        document.querySelector("#menu-detail-img").src = menu['image'];
        document.querySelector("#menu-detail-img").alt = menu['titre'];
        document.querySelector("#menu-detail-input").value = menu['value'];
        document.querySelector("#menu-detail-input").min = menu['min'];

        menuDetailmodal.dataset.menuIdActuel = menuId;
        recalculerPrix();
    }
    function recalculerPrix() {
        const menuId = menuDetailmodal.dataset.menuIdActuel;
        const menu = menusData[menuId];

        if (!menu) return;

        const quantite = parseInt(inputQuantite.value) || 0;
        const prixCalcule = menu['prixUnitaire'] * quantite;

        document.querySelector("#menu-detail-prix-calcule").textContent = `${prixCalcule}€`;
    }

    inputQuantite.addEventListener('input', recalculerPrix);

    const menusGrid = document.querySelector('.menus-grid');

    if (menusGrid) {
        menusGrid.addEventListener('click', function (event) {
            const bouton = event.target.closest('.bouton-voir-detail');
            if (!bouton) return;

            const menuId = bouton.dataset.menuId;
            remplirModaleMenu(menuId);
            menuDetailmodal.classList.add('active');
        });
    }

    inputQuantite.addEventListener('blur', function () {
        const menuId = menuDetailmodal.dataset.menuIdActuel;
        const menu = menusData[menuId];
        if (!menu) return;

        const minimum = menu['min'];
        const valeurSaisie = parseInt(inputQuantite.value) || 0;

        if (valeurSaisie < minimum) {
            inputQuantite.value = minimum;
            recalculerPrix();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            menuDetailmodal.classList.remove('active');
        }
    });

    btnMenuClose.addEventListener('click', function () {
        menuDetailmodal.classList.remove('active');
    });

    menuDetailmodal.addEventListener('click', function (event) {
        if (event.target === menuDetailmodal) {
            menuDetailmodal.classList.remove('active');
        }
    });

// Logique du panier
    const btnAjouterPanier = document.querySelector('#menu-detail-ajouter');
    const panierConfirmationModal = document.querySelector('#panier-confirmation-modal');
    const panierConfirmationClose = document.querySelector('#panier-confirmation-close');
    const panierContinuer = document.querySelector('#btn-continuer-panier');


    if (btnAjouterPanier) {
        btnAjouterPanier.addEventListener('click', async function () {
            const menuId = menuDetailmodal.dataset.menuIdActuel;
            const quantite = inputQuantite.value;

            const donnees = new FormData();
            donnees.append('menu_id', menuId);
            donnees.append('quantite', quantite);

            const reponse = await fetch('panier.php', {
                method: 'POST',
                body: donnees
            });

            const resultat = await reponse.json();

            if (resultat['success']) {
                menuDetailmodal.classList.remove('active');
                if (panierConfirmationModal) {
                    panierConfirmationModal.classList.add('active');
                }
            } else {
                console.error(resultat['message']);
            }
        });
    }

    if (panierContinuer && panierConfirmationModal && panierConfirmationClose) {

        panierConfirmationClose.addEventListener('click', function () {
            panierConfirmationModal.classList.remove('active');
        });

        panierContinuer.addEventListener('click', function () {
            panierConfirmationModal.classList.remove('active');
        });

        panierConfirmationModal.addEventListener('click', function (event) {
            if (event.target === panierConfirmationModal) {
                panierConfirmationModal.classList.remove('active');
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                panierConfirmationModal.classList.remove('active');
            }
        });
    }
}

// boutons - + cartes menus
const btnMoins = document.querySelector("#menu-detail-btn-moins");
const btnPlus = document.querySelector("#menu-detail-btn-plus");

if (btnMoins && btnPlus) {
    btnPlus.addEventListener('click', () => {
        stepOnUp();
        recalculerPrix()
    });

    btnMoins.addEventListener('click', () => {
        stepOnDown();
        recalculerPrix();
    });

    function stepOnUp() {
        let input = document.querySelector("#menu-detail-input");
        input.stepUp();
    }
    function stepOnDown() {
        let input = document.querySelector("#menu-detail-input");
        input.stepDown();
    }
}

// modale tilt

const menuDetailBox = document.querySelector("#menu-detail-modal .modal-box");

if (menuDetailBox) {
    const angleMax = 8;
    const vitesseLissage = 0.3;

    let rectCarte = null;
    let rotateXCible = 0;
    let rotateYCible = 0;
    let rotateXActuel = 0;
    let rotateYActuel = 0;
    let animationEnCours = false;

    function animer() {
        rotateXActuel += (rotateXCible - rotateXActuel) * vitesseLissage;
        rotateYActuel += (rotateYCible - rotateYActuel) * vitesseLissage;

        menuDetailBox.style.transform = `perspective(1000px) rotateX(${rotateXActuel}deg) rotateY(${rotateYActuel}deg)`;

        const ecartRestant = Math.abs(rotateXCible - rotateXActuel) + Math.abs(rotateYCible - rotateYActuel);

        if (ecartRestant > 0.01) {
            requestAnimationFrame(animer);
        } else {
            animationEnCours = false;
        }
    }

    function lancerAnimation() {
        if (!animationEnCours) {
            animationEnCours = true;
            requestAnimationFrame(animer);
        }
    }

    menuDetailBox.addEventListener('mouseenter', function () {
        rectCarte = menuDetailBox.getBoundingClientRect();
    });

    menuDetailBox.addEventListener('mousemove', function (event) {
        if (!rectCarte) return;

        const x = event.clientX - rectCarte.left;
        const y = event.clientY - rectCarte.top;
        const centreX = rectCarte.width / 2;
        const centreY = rectCarte.height / 2;

        rotateYCible = ((x - centreX) / centreX) * angleMax;
        rotateXCible = ((y - centreY) / centreY) * -angleMax;

        lancerAnimation();
    });

    menuDetailBox.addEventListener('mouseleave', function () {
        rectCarte = null;
        rotateXCible = 0;
        rotateYCible = 0;
        lancerAnimation();
    });
}

// fetch filtres
function collecterFiltres() {
    const themesCoches = document.querySelectorAll('.theme input[type="checkbox"]:checked');
    const themes = Array.from(themesCoches).map(function (checkbox) {
        return checkbox.dataset.themeId;
    });

    const regimesCoches = document.querySelectorAll('.regime input[type="checkbox"]:checked');
    const regimes = Array.from(regimesCoches).map(function (checkbox) {
        return checkbox.dataset.regimeId;
    });

    const allergenesCoches = document.querySelectorAll('.allergene input[type="checkbox"]:checked');
    const allergenes = Array.from(allergenesCoches).map(function (checkbox) {
        return checkbox.dataset.allergeneId;
    });

    const prixMin = document.querySelector('#prix-min').value;
    const prixMax = document.querySelector('#prix-max').value;
    const nbrPersonnes = document.querySelector('#nbr-personnes').value;

    return {
        themes: themes,
        regimes: regimes,
        allergenes: allergenes,
        prixMin: prixMin,
        prixMax: prixMax,
        nbrPersonnes: nbrPersonnes
    };
}

function afficherMenus(menus) {
    const grille = document.querySelector('.menus-grid');
    grille.innerHTML = '';

    if (menus.length === 0) {
        grille.innerHTML = '<p class="aucun-resultat">Aucun menu ne correspond à ces critères.</p>';
        return;
    }

    const menusFiltreResultats = document.querySelector('#menus-filtre-resultats');
    if (menusFiltreResultats) {
        if (menus.length > 0) {
            menusFiltreResultats.textContent = `${menus.length} menu${menus.length > 1 ? 's' : ''} trouvé${menus.length > 1 ? 's' : ''}`;
        } else {
            menusFiltreResultats.textContent = "";
        }
    }

    menus.forEach(function (menu) {
        const carte = document.createElement('div');
        carte.classList.add('menus-box');

        carte.innerHTML = `
            <img src="${menu['image_url']}" alt="${menu['titre']}">
            <div class="menus-box-titre-visible">
                <h3>${menu['titre']}</h3>
                <div class="menus-voir-detail-bouton">
                    <button type="button" class="bouton-voir-detail" data-menu-id="${menu['menu_id']}">Voir le détail</button>
                </div>
            </div>
        `;

        grille.appendChild(carte);
    });
}

async function filtrerMenus() {
    const filtres = collecterFiltres();

    const params = new URLSearchParams();

    filtres.themes.forEach(function (id) {
        params.append('themes[]', id);
    });
    filtres.regimes.forEach(function (id) {
        params.append('regimes[]', id);
    });
    filtres.allergenes.forEach(function (id) {
        params.append('allergenes[]', id);
    });
    params.append('prixMin', filtres.prixMin);
    params.append('prixMax', filtres.prixMax);
    params.append('nbrPersonnes', filtres.nbrPersonnes);

    const reponse = await fetch('filtrer-menus.php?' + params.toString());
    const data = await reponse.json();

    afficherMenus(data);
}

const btnFiltrerTest = document.querySelector('#valider-filtrer-btn');

if (btnFiltrerTest) {
    btnFiltrerTest.addEventListener('click', function () {
        filtrerMenus();
    });
}


// reset sidebar filtre
const btnReset = document.querySelector('#reset-filtrer-btn');

if (btnReset) {
    btnReset.addEventListener('click', function () {
        document.querySelectorAll('.sidebar-menu input[type="checkbox"]').forEach(function (checkbox) {
            checkbox.checked = false;
        });

        document.querySelector('#prix-min').value = 0;
        document.querySelector('#prix-max').value = 200;
        document.querySelector('#prix-min-valeur').textContent = '0€';
        document.querySelector('#prix-max-valeur').textContent = '200€';

        document.querySelector('#nbr-personnes').value = 50;
        document.querySelector('#nbr-personnes-valeur').textContent = '50';

        const grille = document.querySelector('.menus-grid');
        grille.innerHTML = '<p class="aucun-resultat">Veuillez définir votre recherche à l\'aide des filtres, puis cliquer sur "Valider".</p>';

        document.querySelector('#menus-filtre-resultats').textContent = '';
    });
}

// curseur nrb personnes + prix filtre
const inputNbrPersonnes = document.querySelector('#nbr-personnes');
const spanNbrPersonnesValeur = document.querySelector('#nbr-personnes-valeur');

if (inputNbrPersonnes && spanNbrPersonnesValeur) {
    inputNbrPersonnes.addEventListener('input', function () {
        spanNbrPersonnesValeur.textContent = inputNbrPersonnes.value;
    });
}

const prixMinFiltre = document.querySelector('#prix-min');
const prixMaxFiltre = document.querySelector('#prix-max');
const spanPrixMinValeur = document.querySelector('#prix-min-valeur');
const spanPrixMaxValeur = document.querySelector('#prix-max-valeur');

if (prixMinFiltre && prixMaxFiltre && spanPrixMinValeur && spanPrixMaxValeur) {
    prixMinFiltre.addEventListener('input', function () {
        spanPrixMinValeur.textContent = prixMinFiltre.value;
    });
    prixMaxFiltre.addEventListener('input', function () {
        spanPrixMaxValeur.textContent = prixMaxFiltre.value;
    });
}



