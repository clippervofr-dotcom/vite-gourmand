

const adminStatistiquesBox = document.querySelector('.profil-admin-box-voir-statistiques');

if (adminStatistiquesBox) {

    async function chargerStats() {
        const reponse = await fetch('statistiques.php');
        const resultats = reponse.json();

        afficherStats(resultats);
    }

    function afficherStats(resultats) {


        document.querySelector('#ca-du-mois').textContent =
        document.querySelector('#nbr-commandes-by-statut').textContent =
        document.querySelector('#note-moyenne').textContent = resultats['moyenne_avis'];
        document.querySelector('#taux-annulation').textContent = resultats['taux_annulation'];
    }
}

const valeurParStatut = resultats['commandes_par_statut'];
const statutStatsAdmin = document.querySelector('#status-stats-admin');
const optionStatutChoisi = statutStatsAdmin.value;

foreach (resultats as resultat) {
    if (resultat[0] === optionStatutChoisi) {
        document.querySelector('#nbr-commandes-by-statut').textContent = resultat[1];
    }
}