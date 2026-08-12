let derniereStatistiques = [];
let choixMoisDemander = 'tous';
if (adminStatistiquesBox) {

    async function chargerStats() {
        const moisDemanderMaintenant = 'tous';
        const reponse = await fetch('statistiques.php');
        const resultats = await reponse.json();

        if (moisDemanderMaintenant === choixMoisDemander) {
            derniereStatistiques = resultats;
            afficherStats(resultats);
        }
    }

    function afficherStats(resultats) {

        document.querySelector('#nom-du-mois').textContent = resultats['ca_par_mois'][0].nom;
        document.querySelector('#ca-du-mois').textContent = resultats['ca_par_mois'][0].prix_total;
        document.querySelector('#note-moyenne').textContent = resultats['moyenne_avis'];
        document.querySelector('#taux-annulation').textContent = resultats['taux_annulation'];
        document.querySelector('#ca-total').textContent = resultats['ca_total'];


        const conteneurCommandesStats = document.querySelector('.profil-admin-container');
        conteneurCommandesStats.querySelectorAll('.profil-admin-statistiques-ligne').forEach (function (ligne) {
            ligne.remove();
        });

        resultats['commandes_par_menu'].forEach(function (commande) {
            const ligne = document.createElement('div');
            ligne.classList.add('profil-admin-statistiques-ligne');
            ligne.innerHTML = `
        <span class="commandes-champ" data-label="titre-menu">${echapperHTML(commande.nom_menu)}</span>
        <span class="commandes-champ" data-label="nbr-commandes-par-menu">${echapperHTML(commande.nrb_commande_menu)}</span>
        <span class="commandes-champ" data-label="ca-par-menu">${echapperHTML(commande.ca_par_commande)}</span>
    `;
            conteneurCommandesStats.appendChild(ligne);
        });
    }

    const choixMois = document.querySelector('#periode-stats-admin');
    choixMois.addEventListener('change', async function () {
        const moisDemanderMaintenant = choixMois.value;
        choixMoisDemander = moisDemanderMaintenant;

        const params = new URLSearchParams();
        params.append('choix_mois', choixMois.value);

        const reponse = await fetch('statistiques.php?' + params.toString());
        const data = await reponse.json();

        if (moisDemanderMaintenant === choixMoisDemander) {
            derniereStatistiques = data;
            afficherStats(data);
        }
    });

    const statutStatsAdmin = document.querySelector('#status-stats-admin');
    statutStatsAdmin.addEventListener('change', function () {
        const optionStatutChoisi = statutStatsAdmin.value;
        derniereStatistiques['commandes_par_statut'].forEach(function (statut) {
            if (optionStatutChoisi === statut.statut) {
                document.querySelector('#nbr-commandes-by-statut-name').textContent = capitalizeFirstLetter(statut.statut);
                document.querySelector('#nbr-commandes-by-statut').textContent = statut.nombre;
            }
        });
    })

    chargerStats();
}

