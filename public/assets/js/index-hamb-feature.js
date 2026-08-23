
//ouverture menu profil + fermeture click en dehors
const btnProfil = document.querySelector('#btn-profil');
const dropdownProfil = document.querySelector('.dropdown-profil');
const profilBox = document.querySelector('.profil-box')

if (btnProfil && dropdownProfil && profilBox) {
    function toggleDropdownProfil() {
        dropdownProfil.classList.toggle('active');
    }

    btnProfil.addEventListener('click', function (event) {
        event.stopPropagation();
        toggleDropdownProfil();
    });

    document.addEventListener('click', function (event) {
        if (dropdownProfil.classList.contains('active') && !profilBox.contains(event.target)) {
            dropdownProfil.classList.remove('active');
        }
    });
}

//check si le 1er mdp et 2eme mdp dans formulaire inscription sont similaire
const mdp = document.getElementById('mdp');
const mdpConfirm = document.getElementById('mdp-confirm');
const messageErreur = document.getElementById('erreur-mdp');

if (mdp && mdpConfirm && messageErreur) {
    function verifierMdp() {
        if (mdp.value === mdpConfirm.value) {
            messageErreur.textContent = '';
            mdpConfirm.setCustomValidity('');
        } else {
            messageErreur.textContent = 'Les mots de passe ne correspondent pas.';
            mdpConfirm.setCustomValidity('Les mots de passe ne correspondent pas.');
        }
    }
    mdpConfirm.addEventListener('input', verifierMdp);
}

// ouverture-fermeture menu hamburger / header responsive
const navlinksMenus = document.querySelector('#nav-links-menus');
const btnNavHamburger = document.querySelector('#bouton-nav-hamburger');

if (navlinksMenus && btnNavHamburger) {
    btnNavHamburger.addEventListener('click', function () {
        const estOuvert = navlinksMenus.classList.toggle('active');
        btnNavHamburger.setAttribute('aria-expanded', estOuvert);

        if (dropdownProfil) {
            dropdownProfil.classList.remove('active');
        }
    });

    document.addEventListener(('keydown'), function (event) {
        if (event.key === 'Escape') {
            navlinksMenus.classList.remove('active')
        }
    });

    document.addEventListener('click', function (event) {
        const clicDansHamburger = navlinksMenus.contains(event.target);
        const clicSurBouton = btnNavHamburger.contains(event.target);

        if (navlinksMenus.classList.contains('active') && !clicDansHamburger && !clicSurBouton) {
            navlinksMenus.classList.remove('active');
        }
    });
}

// carroussel mobile
const btnSuivant = document.querySelector('#avis-suiv');
const btnPrecedent = document.querySelector('#avis-prec');
const commMegabox = document.querySelector('.commentaires-mega-box');

if (btnSuivant && btnPrecedent && commMegabox) {
    function largeurCarte() {
        const premiereCarte = commMegabox.querySelector('.commentaires-box');
        return premiereCarte ? premiereCarte.offsetWidth + 20 : 0;
    }

    let indexActuel = 0;

    function afficherCarteIndex(index) {
        const cartes = commMegabox.querySelectorAll('.commentaires-box');

        cartes.forEach(function (carte) {
            carte.classList.remove('active');
        });

        if (cartes[index]) {
            cartes[index].classList.add('active');
        }
    }

    btnSuivant.addEventListener('click', function () {
        commMegabox.scrollBy({ left: largeurCarte(), behavior: 'smooth' });

        const cartes = commMegabox.querySelectorAll('.commentaires-box');
        indexActuel = (indexActuel + 1) % cartes.length;
        afficherCarteIndex(indexActuel);
    });

    btnPrecedent.addEventListener('click', function () {
        commMegabox.scrollBy({ left: -largeurCarte(), behavior: 'smooth' });

        const cartes = commMegabox.querySelectorAll('.commentaires-box');
        indexActuel = (indexActuel - 1 + cartes.length) % cartes.length;
        afficherCarteIndex(indexActuel);
    });
}

if (commMegabox) {
    async function chargerAvis() {
        const reponse = await fetch('/avis/avis-get.php');
        const resultatAvis = await reponse.json();

        afficherAvis(resultatAvis['avis']);
    }

    function genererEtoiles(note) {
        let html = '';
        for (let i = 1; i <= 5; i++) {
            const classe = i <= note ? 'fa fa-star star-pleine' : 'fa fa-star star-vide';
            html += `<span class="${classe}"></span>`;
        }
        return html;
    }

    function afficherAvis(resultatAvis) {
        const conteneurAvis = document.querySelector('.commentaires-mega-box');

        conteneurAvis.querySelectorAll('.commentaires-box').forEach(function (ligne) {
            ligne.remove();
        });

        resultatAvis.forEach(function (avis) {
            const ligne = document.createElement('div');
            ligne.classList.add('commentaires-box');

            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const dateAvis = new Date(avis['date_avis']);
            const dateAvisString = dateAvis.toLocaleDateString('fr-FR', options);

            ligne.innerHTML = `
                <span class="auteur">${echapperHTML(avis['nom'])} ${echapperHTML(avis['prenom'])}</span>
                <span class="date-avis">${capitalizeFirstLetter(dateAvisString)}</span>
                <span class="commentaires-texte">"${echapperHTML(avis['commentaire'])}."</span>
                <div class="commentaire-content-user-etoiles">
                    ${genererEtoiles(avis['note'])}
                </div>
            `;
            conteneurAvis.appendChild(ligne);
        });
        indexActuel = 0;
        afficherCarteIndex(0);
    }

    const echelleMax = 1;
    const echelleMin = 0.85;
    function mettreAJourEchelle() {
        const rectContainer = commMegabox.getBoundingClientRect();
        const centreContainer = rectContainer.left + rectContainer.width / 2;

        const cartes = commMegabox.querySelectorAll('.commentaires-box');

        cartes.forEach(function (carte) {
            const rectCarte = carte.getBoundingClientRect();
            const centreCarte = rectCarte.left + rectCarte.width / 2;

            const distance = Math.abs(centreCarte - centreContainer);
            const distanceNormalisee = Math.min(distance / (rectContainer.width / 2), 1);

            const echelle = echelleMax - (echelleMax - echelleMin) * distanceNormalisee;

            carte.style.transform = `scale(${echelle})`;
        });
    }

    let enAttente = false;
    commMegabox.addEventListener('scroll', function () {
        if (!enAttente) {
            enAttente = true;
            requestAnimationFrame(function () {
                mettreAJourEchelle();
                enAttente = false;
            });
        }
    });

    mettreAJourEchelle();
    chargerAvis().catch(function (erreur) {
        console.error('Erreur lors du chargement des avis :', erreur);
    });
}

//scroll to top btn
document.querySelector('#btn-to-top')?.addEventListener('click', function (event) {
    event.preventDefault();
    window.scrollTo({ top: 0, behavior: 'smooth' });
});


(function () {
    const bdyHeader = document.querySelector('.body-header');
    if (!bdyHeader) return;
    const role = parseInt(bdyHeader.dataset.roleId);
    if (role === 2 || role === 3) {
        document.querySelector('#bouton-devis').style.display = 'none';
        document.querySelector('#bouton-menus').style.display = 'none';
        document.querySelector('#bouton-panier').style.display = 'none';
        document.querySelector('#nav-links-menus').style.gridTemplateColumns = '1fr';
        document.querySelector('#nav-links-menus').style.gap = '0';
        document.querySelector('.nav-links-principal').style.flexDirection = 'row';
    }
})();

// const conteneur = document.querySelector('.tarteaucitronName');
//
// if (conteneur) {
//
//     const ligne = document.createElement('div');
//     ligne.classList.add('tarteaucitronLegal');
//     ligne.innerHTML =
//         '<a href="/legal/mentions-legales.php">Voir les mentions légales</a>';
//
//     conteneur.appendChild(ligne);
// }