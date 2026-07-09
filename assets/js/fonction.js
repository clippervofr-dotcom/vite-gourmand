
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



