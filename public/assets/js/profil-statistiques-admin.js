let derniereStatistiques = [];
let choixMoisDemander = 'Tous';
if (adminStatistiquesBox) {

    async function chargerStats() {
        const moisDemanderMaintenant = 'Tous';
        const reponse = await fetch('/admin/statistiques.php');
        const resultats = await reponse.json();

        if (moisDemanderMaintenant === choixMoisDemander) {
            derniereStatistiques = resultats;
            afficherStats(resultats);
        }
    }

    function afficherStats(resultats) {
        const tauxAnnulation = document.querySelector('#taux-annulation');
        const moyenneAvis = document.querySelector('#note-moyenne');
        const moisAvecVoyelle = ['Avril', 'Août', 'Octobre'];

        document.querySelector('#note-moyenne').textContent = resultats['moyenne_avis'];
        if (parseFloat(resultats['moyenne_avis']) < 3) {
            moyenneAvis.style.color = 'red';
        } else {
            moyenneAvis.style.color = 'green';
        }
        document.querySelector('#taux-annulation').textContent = resultats['taux_annulation'];
        if (parseFloat(resultats['taux_annulation']) > 10) {
            tauxAnnulation.style.color = 'red';
        } else {
            tauxAnnulation.style.color = 'green';
        }
        document.querySelector('#ca-total').textContent = resultats['ca_total'] + ' €';
        document.querySelector('#nbr-commandes-by-statut-name-en-attente').textContent = capitalizeFirstLetter(resultats['commandes_par_statut'][0].statut) + ' :';
        document.querySelector('#nbr-commandes-by-statut-name-validee').textContent = capitalizeFirstLetter(resultats['commandes_par_statut'][1].statut) + ' :';
        document.querySelector('#nbr-commandes-by-statut-name-terminee').textContent = capitalizeFirstLetter(resultats['commandes_par_statut'][2].statut) + ' :';
        document.querySelector('#nbr-commandes-by-statut-name-annulee').textContent = capitalizeFirstLetter(resultats['commandes_par_statut'][3].statut) + ' :';
        document.querySelector('#nbr-commandes-by-statut-en-attente').textContent = resultats['commandes_par_statut'][0].nombre;
        document.querySelector('#nbr-commandes-by-statut-validee').textContent = resultats['commandes_par_statut'][1].nombre;
        document.querySelector('#nbr-commandes-by-statut-terminee').textContent = resultats['commandes_par_statut'][2].nombre;
        document.querySelector('#nbr-commandes-by-statut-annulee').textContent = resultats['commandes_par_statut'][3].nombre;

        if (resultats['mois_filtre'] === null) {
            document.querySelector('#details-commandes-du-mois').textContent = 'Détails des commandes totales';
            document.querySelector('#montant-ca-total-mois').textContent = resultats['ca_total'] + ' €';
        } else if (resultats['ca_par_mois'].length > 0) {
            document.querySelector('#details-commandes-du-mois').textContent = moisAvecVoyelle.includes(resultats['ca_par_mois'][0].nom) ?
                'Détails des commandes pour le mois d\'' + resultats['ca_par_mois'][0].nom
                : 'Détails des commandes pour le mois de ' + resultats['ca_par_mois'][0].nom;
            document.querySelector('#montant-ca-total-mois').textContent = resultats['ca_par_mois'][0].prix_total + ' €';
        } else {
            document.querySelector('#details-commandes-du-mois').textContent = 'Aucun résultat pour ' + choixMois.options[choixMois.selectedIndex].text;
            document.querySelector('#montant-ca-total-mois').textContent = '0 €';
        }

        const conteneurCommandesStats = document.querySelector('.profil-admin-container');
        conteneurCommandesStats.querySelectorAll('.profil-admin-statistiques-ligne').forEach (function (ligne) {
            ligne.remove();
        });

        resultats['commandes_par_menu'].forEach(function (commande) {
            const ligne = document.createElement('div');
            ligne.classList.add('profil-admin-statistiques-ligne');
            ligne.innerHTML = `
        <span class="commandes-champ" data-label="Titre du menu">${echapperHTML(commande.nom_menu)}</span>
        <span class="commandes-champ-center" data-label="Commandes en attente">${echapperHTML(commande.en_attente)}</span>
        <span class="commandes-champ-center" data-label="Commandes validées">${echapperHTML(commande.validée)}</span>
        <span class="commandes-champ-center" data-label="Commandes terminées">${echapperHTML(commande.terminée)}</span>
        <span class="commandes-champ-center" data-label="Commandes annulées">${echapperHTML(commande.annulée)}</span>
        <span class="commandes-champ-center" data-label="Nombre de commandes par menu">${echapperHTML(commande.nbr_commande_menu)}</span>
        <span class="commandes-champ-center" data-label="Taux d'annulation">${echapperHTML(commande.taux_annulation)}</span>
        <span class="commandes-champ-center" data-label="CA par menu">${echapperHTML(commande.ca_par_commande)} €</span>
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

        const reponse = await fetch('/admin/statistiques.php?' + params.toString());
        const data = await reponse.json();

        if (moisDemanderMaintenant === choixMoisDemander) {
            derniereStatistiques = data;
            afficherStats(data);
        }
    });
    chargerStats();
}