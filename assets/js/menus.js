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

const filtrerBtnbox = document.querySelector("#filtrer-btn");

if (filtrerBtnbox) {
    filtrerBtnbox.addEventListener('click', function () {
        sidebarMenu.classList.remove('active');
    });
}

const menuDetailmodal = document.querySelector("#menu-detail-modal");
const btnVoirDetail = document.querySelectorAll(".bouton-voir-detail");
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


if (menuDetailmodal && btnMenuClose && btnVoirDetail.length > 0) {
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

    btnVoirDetail.forEach(function (bouton) {
        bouton.addEventListener('click', function () {
            const menuId = bouton.dataset.menuId;
            remplirModaleMenu(menuId);
            menuDetailmodal.classList.add('active');
        });
    });

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

