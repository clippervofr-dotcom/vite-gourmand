let dernierMenusAffiches = [];

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

if (menuDetailmodal && btnMenuClose) {
    function remplirModaleMenu(menuId) {
        const menu = dernierMenusAffiches.find(menu => menu['menu_id'] === parseInt(menuId));
        if (!menu) return;

        document.querySelector("#menu-detail-titre").textContent = menu['titre'];
        document.querySelector("#menu-detail-description").textContent = menu['description_menu'];

        document.querySelector('#menu-detail-entree-1').textContent = menu['plats'][0]['nom'];
        document.querySelector('#menu-detail-entree-2').textContent = menu['plats'][1]['nom'];
        document.querySelector('#menu-detail-plat-1').textContent = menu['plats'][2]['nom'];
        document.querySelector('#menu-detail-plat-2').textContent = menu['plats'][3]['nom'];
        document.querySelector('#menu-detail-dessert-1').textContent = menu['plats'][4]['nom'];
        document.querySelector('#menu-detail-dessert-2').textContent = menu['plats'][5]['nom'];

        document.querySelector("#menu-detail-prix").textContent = `${menu['prix_par_personne']}€ / pers.`;
        document.querySelector('#menu-detail-personne-minimum').textContent = `(minimum : ${menu['nombre_personne_minimum']})`;
        document.querySelector('#menu-detail-condition').textContent = menu['conditions'];

        if (menu['allergenes'].length > 0) {
            if (menu['allergenes'].includes("Oeufs") || menu['allergenes'].includes("Arachides")) {
                if (menu['allergenes'][1].includes("Arachides") || menu['allergenes'][1].includes("Oeufs")) {
                    document.querySelector("#menu-detail-allergenes").textContent = menu['allergenes'].length > 1 ? `Présence d'${menu['allergenes'].join(' et d\'')}` : `Présence d'${menu['allergenes']}`;
                } else {
                    document.querySelector("#menu-detail-allergenes").textContent = menu['allergenes'].length > 1 ? `Présence d'${menu['allergenes'].join(' et de ')}` : `Présence d'${menu['allergenes']}`;
                }
            } else {
                document.querySelector("#menu-detail-allergenes").textContent = menu['allergenes'].length > 1 ? `Présence de ${menu['allergenes'].join('et de ')}` : `Présence de ${menu['allergenes']}`;
            }
        } else {
            document.querySelector("#menu-detail-allergenes").textContent = "Aucun allergène connu";
        }

        let texteStock;
        if (menu['quantite_restante'] === undefined) {
            texteStock = "Stock non renseigné";
        } else if (menu['quantite_restante'] === 0) {
            texteStock = "Stock épuisé";
            document.querySelector("#menu-detail-stock").style.color = "var(--couleur-police-epuise)";
        } else {
            texteStock = `Stock : ${menu['quantite_restante']} disponibles`;
            document.querySelector("#menu-detail-stock").style.color = "var(--couleur-police-stock)";
        }
        document.querySelector("#menu-detail-stock").textContent = texteStock;
        document.querySelector("#menu-detail-img").src = menu['image_url'];
        document.querySelector("#menu-detail-img").alt = menu['titre'];
        document.querySelector("#menu-detail-input").value = menu['nombre_personne_minimum'];
        document.querySelector("#menu-detail-input").min = menu['nombre_personne_minimum'];

        menuDetailmodal.dataset.menuIdActuel = menuId;
        recalculerPrix();
    }
    function recalculerPrix() {
        const menuId = menuDetailmodal.dataset.menuIdActuel;
        const menu = dernierMenusAffiches.find(menu => menu['menu_id'] === parseInt(menuId));
        if (!menu) return;

        const reduction = 0.10; // 10% de réduction
        const quantite = parseInt(inputQuantite.value) || 0;
        const prixCalcule = menu['prix_par_personne'] * quantite;

        if (quantite >= (parseInt(menu['nombre_personne_minimum']) + 5)) {
            const prixReduit = prixCalcule - (prixCalcule * reduction);
            document.querySelector("#menu-detail-prix-calcule").textContent = `${prixReduit}€`;
        } else {
            document.querySelector("#menu-detail-prix-calcule").textContent = `${prixCalcule}€`;
        }
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
        const menu = dernierMenusAffiches.find(menu => menu['menu_id'] === parseInt(menuId));
        if (!menu) return;

        const minimum = menu['min'];
        const valeurSaisie = parseInt(inputQuantite.value) || 0;

        if (valeurSaisie < minimum) {
            inputQuantite.value = minimum;
            recalculerPrix();
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
            donnees.append('csrf_token', getCsrfToken());

            console.log(menuId, quantite)

            try {
                const reponse = await fetch('/panier/panier.php', {
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
            } catch (erreur) {
                console.error('Erreur lors de l\'ajout au panier :', erreur);
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

    // modale image plats
    const imagePlatsModal = document.querySelector('#menu-detail-img-modal');
    const imagePlatsModalClose = document.querySelector('#menu-detail-img-close');

    const btnImagePlatsE1 = document.querySelector('#menu-detail-entree-1');
    const btnImagePlatsP1 = document.querySelector('#menu-detail-plat-1');
    const btnImagePlatsD1 = document.querySelector('#menu-detail-dessert-1');

    const btnImagePlatsE2 = document.querySelector('#menu-detail-entree-2');
    const btnImagePlatsP2 = document.querySelector('#menu-detail-plat-2');
    const btnImagePlatsD2 = document.querySelector('#menu-detail-dessert-2');

    if (btnImagePlatsE1 && btnImagePlatsE2 && btnImagePlatsP1 && btnImagePlatsP2 && btnImagePlatsD1 && btnImagePlatsD2) {

        function ouvrirImagePlatsModal(indexPlat) {
            const menuId = menuDetailmodal.dataset.menuIdActuel;
            const menu = dernierMenusAffiches.find(menu => menu['menu_id'] === parseInt(menuId));
            if (!menu) return;

            const titreImage = document.querySelector('.menu-detail-titre-img');
            const imagePlats = document.querySelector('#menu-detail-img-modal-img');
            const descriptionPlats = document.querySelector('.menu-detail-description-img');

            imagePlats.src = menu['plats'][indexPlat]['photo'];
            imagePlats.alt = menu['plats'][indexPlat]['nom'];
            titreImage.textContent = menu['plats'][indexPlat]['nom'];
            descriptionPlats.textContent = menu['plats'][indexPlat]['description_plat'];

            imagePlatsModal.classList.add('active');
        }

        imagePlatsModal.addEventListener('click', function (event) {
            if (event.target === imagePlatsModal || event.target === imagePlatsModalClose) {
                imagePlatsModal.classList.remove('active');
            }
        });

        btnImagePlatsE1.addEventListener('click', function () {
            ouvrirImagePlatsModal(0);
        });

        btnImagePlatsE2.addEventListener('click', function () {
            ouvrirImagePlatsModal(1);
        });

        btnImagePlatsP1.addEventListener('click', function () {
            ouvrirImagePlatsModal(2);
        });

        btnImagePlatsP2.addEventListener('click', function () {
            ouvrirImagePlatsModal(3);
        });

        btnImagePlatsD1.addEventListener('click', function () {
            ouvrirImagePlatsModal(4);
        });

        btnImagePlatsD2.addEventListener('click', function () {
            ouvrirImagePlatsModal(5);
        });


        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                if (imagePlatsModal.classList.contains('active')) {
                    imagePlatsModal.classList.remove('active');
                } else {
                    menuDetailmodal.classList.remove('active');
                }
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

// modale tilt le GOaoulde xD
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
    dernierMenusAffiches = menus;

    console.log(menus);

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
                <h3>${echapperHTML(menu['titre'])}</h3>
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

    try {
        const reponse = await fetch('/menus/filtrer-menus.php?' + params.toString());
        const data = await reponse.json();

        afficherMenus(data);
    } catch (erreur) {
        console.error('Erreur lors du filtrage des menus :', erreur);
    }

}

const btnFiltrerTest = document.querySelector('#valider-filtrer-btn');

if (btnFiltrerTest) {
    btnFiltrerTest.addEventListener('click', function () {
        filtrerMenus().catch(function (erreur) {
            console.error('Erreur de la validation des filtres :', erreur);
        });
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

// images plats modale





