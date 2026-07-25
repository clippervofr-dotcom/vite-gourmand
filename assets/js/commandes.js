

const conteneurCommandes = document.querySelector('.profil-employe-commandes-liste');

if (conteneurCommandes) {
    async function chargerCommandesEnAttente() {
        const reponse = await fetch('commandes-en-attente.php');
        const commandesEnAttente = await reponse.json();

        afficherCommandes(commandesEnAttente);
    }

    function afficherCommandes(commandesEnAttente) {
        const conteneur = document.querySelector('.profil-employe-commandes-liste');

        conteneur.querySelectorAll('.profil-employe-commandes-ligne').forEach(function (ligne) {
            ligne.remove();
        });

        commandesEnAttente.forEach(function (commande) {
            const ligne = document.createElement('div');
            ligne.classList.add('profil-employe-commandes-ligne');
            ligne.innerHTML = `
                <span class="commandes-champ" data-label="Commande n°">${commande['numero_commande']}</span>
                <span class="commandes-champ" data-label="Nom du menu">${commande['titre']}</span>
                <span class="commandes-champ" data-label="Nbr de personnes">${commande['nombre_personnes']}</span>
                <span class="commandes-champ" data-label="Date prestation">${commande['date_prestation']}</span>
                <span class="commandes-champ" data-label="Status">${commande['status']}</span>
                <span class="commandes-champ" data-label="Commentaires">${commande['motif_annulation'] ?? '-'}</span>
            `;
            conteneur.appendChild(ligne);
        });
    }

    chargerCommandesEnAttente().catch(function (erreur) {
        console.error('Erreur lors du chargement des commandes en attente :', erreur);
    });
}


