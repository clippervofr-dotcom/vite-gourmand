if (adminStatistiquesBox) {

    async function chargerStats() {
        const reponse = await fetch('statistiques.php');
        const resultats = await reponse.json();

        afficherStats(resultats);
    }

    function afficherStats(resultats) {

        const valeurParStatut = resultats['commandes_par_statut'];
        const statutStatsAdmin = document.querySelector('#status-stats-admin');
        const optionStatutChoisi = statutStatsAdmin.value;
        valeurParStatut.forEach(function (resultat) {
            if (resultat[0] === optionStatutChoisi) {
                document.querySelector('#nbr-commandes-by-statut').textContent = resultat[1];
            }
        });

        document.querySelector('#ca-du-mois').textContent = resultats['ca_par_mois'];
        document.querySelector('#nbr-commandes-by-statut').textContent = resultats['commandes_par_menu'];
        document.querySelector('#note-moyenne').textContent = resultats['moyenne_avis'];
        document.querySelector('#taux-annulation').textContent = resultats['taux_annulation'];


        const conteneurCommandesStats = document.querySelector('.profil-admin-container');
        conteneurCommandesStats.querySelectorAll('.profil-admin-statistiques-ligne').forEach (function (ligne) {
            ligne.remove();
        });

        resultats.forEach(function (commande) {
            const ligne = document.createElement('div');
            ligne.classList.add('profil-admin-statistiques-ligne');
            ligne.innerHTML = `
        <span class="commandes-champ" data-label="titre-menu">${resultats['commandes_par_menu'][0]}</span>
        <span class="commandes-champ" data-label="nbr-commandes-par-menu">${resultats['commandes_par_menu'][1]}</span>
        <span class="commandes-champ" data-label="ca-par-menu">${resultats['commandes_par_menu']}</span>
    `;
        });
    }

    const choixMois = document.querySelector('#periode-stats-admin');
    choixMois.addEventListener('change', async function () {
        const params = new URLSearchParams();
        params.append('choix_mois', choixMois.value);

        const reponse = await fetch('statistiques.php?' + params.toString());
        const data = await reponse.json();

        afficherStats(data);
    })

    chargerStats();
}

