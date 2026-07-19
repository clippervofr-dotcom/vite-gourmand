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




