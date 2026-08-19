const devisForm = document.querySelector("#devis-form");
const btnDevis = document.querySelector("#bouton-devis");
const devisModal = document.querySelector("#devis-modal");
const devisErreur = document.querySelector("#devis-erreur");
const confirmationModal = document.querySelector("#devis-confirmation");
const devisClose = document.querySelector("#devis-close");
const confirmationClose = document.querySelector("#confirmation-close");


if (btnDevis && devisModal && devisForm) {
    
    btnDevis.addEventListener('click', function () {
        devisModal.classList.add('active');
    });

    devisClose.addEventListener('click', function () {
        devisModal.classList.remove('active');
    });

    devisModal.addEventListener('click', function (event) {
        if (event.target === devisModal) {
            devisModal.classList.remove('active')
        }
    });

    confirmationClose.addEventListener('click', function () {
        confirmationModal.classList.remove('active');
    });

    confirmationModal.addEventListener('click', function (event) {
        if (event.target === confirmationModal) {
            confirmationModal.classList.remove('active');
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            devisModal.classList.remove('active');
            confirmationModal.classList.remove('active');
        }
    });

    devisForm.addEventListener('submit', async function (event) {
        event.preventDefault();
        
        const donnees = new FormData(devisForm);
        donnees.append('csrf_token', getCsrfToken());

        const reponse = await fetch('traitement-devis.php', {method: 'POST', body: donnees});

        const reponseDonnees = await reponse.json();

        if (reponseDonnees.success) {
            devisErreur.textContent = '';
            devisForm.reset();
            devisModal.classList.remove('active');
            confirmationModal.classList.add('active');
            confirmationModal.style.color = "var(--couleur-police-stock)";

        } else {
            devisErreur.textContent = reponseDonnees.message;
            devisErreur.style.color = "var(--couleur-police-epuiser)";
        }
    })
}

const contactForm = document.querySelector("#formulaire-contact");
const contactErreur = document.querySelector("#contact-erreur");

if (contactForm) {
    contactForm.addEventListener('submit', async function (event) {
        event.preventDefault();

        const donnees = new FormData(contactForm);
        donnees.append('csrf_token', getCsrfToken());
        const reponse = await fetch('traitement-contact.php', {method: 'POST', body: donnees});
        const reponseDonnees = await reponse.json();

        if (reponseDonnees.success) {
            contactErreur.textContent = '';
            contactForm.reset();
            confirmationModal.classList.add('active');
            confirmationModal.style.color = "var(--couleur-police-stock)";
        } else {
            contactErreur.textContent = reponseDonnees.message;
            contactErreur.style.color = "var(--couleur-police-epuiser)";
        }
    })
}





