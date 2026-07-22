
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

    btnSuivant.addEventListener('click', function () {
        commMegabox.scrollBy({ left: largeurCarte(), behavior: 'smooth' });
    });

    btnPrecedent.addEventListener('click', function () {
        commMegabox.scrollBy({ left: -largeurCarte(), behavior: 'smooth' });
    });
}


//scroll to top btn
$(function () {
    $("#btn-to-top").click(function () {
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });
});


