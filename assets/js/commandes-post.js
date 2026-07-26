const newAdresseModal = document.querySelector('#new-adresse-modal');
const newAdresseModalClose = document.querySelector('#new-adresse-modal-close');
const newAdresseCheckbox = document.querySelector('#new-adresse-checkbox');
const newAdresseConfirm = document.querySelector('#btn-new-adresse-confirm');
const addNewAdress = document.querySelector('#add-new-adresse');

if (newAdresseModal && newAdresseCheckbox && newAdresseModalClose && newAdresseConfirm && addNewAdress) {
    addNewAdress.addEventListener('click', function () {
        newAdresseModal.classList.add('active');
    });

    newAdresseCheckbox.checked = false;
    newAdresseConfirm.disabled = true;

    newAdresseCheckbox.addEventListener('change', function () {
        newAdresseConfirm.disabled = !newAdresseCheckbox.checked;
    });

    newAdresseModalClose.addEventListener('click', function () {
        newAdresseModal.classList.remove('active');
    });

    newAdresseModal.addEventListener('click', function (event) {
        if (event.target === newAdresseModal) {
            newAdresseModal.classList.remove('active');
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            newAdresseModal.classList.remove('active');
        }
    });
}