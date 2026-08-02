const conteneurHoraires = document.querySelector('.footer-local__details');

if (conteneurHoraires) {

    async function chargerHoraires() {
        const reponse = await fetch('horaires-chargement.php');
        const horairesChargement = await reponse.json();

        afficherHoraires(horairesChargement);
    }

    function afficherHoraires(horairesChargement) {
        const conteneur = document.querySelector('.footer-local__details');

        conteneur.querySelectorAll('.footer-local__hours-list').forEach(function (ligne) {
            ligne.remove();
        });

        console.log(horairesChargement);

        const ligne = document.createElement('ul');
        ligne.classList.add('footer-local__hours-list');
        ligne.innerHTML = `
                    <li><span class="day">Lundi :</span> <span class="time">${horairesChargement[0]['heure_ouverture'] + " - " + horairesChargement[0]['heure_fermeture']}</span></li>
                    <li><span class="day">Mardi :</span> <span class="time">${horairesChargement[1]['heure_ouverture'] + " - " + horairesChargement[1]['heure_fermeture']}</span></li>
                    <li><span class="day">Mercredi :</span> <span class="time">${horairesChargement[2]['heure_ouverture'] + " - " + horairesChargement[2]['heure_fermeture']}</span></li>
                    <li><span class="day">Jeudi :</span> <span class="time">${horairesChargement[3]['heure_ouverture'] + " - " + horairesChargement[3]['heure_fermeture']}</span></li>
                    <li><span class="day">Vendredi :</span> <span class="time">${horairesChargement[4]['heure_ouverture'] + " - " + horairesChargement[4]['heure_fermeture']}</span></li>
                    <li><span class="day">Samedi :</span> <span class="time">${horairesChargement[5]['heure_ouverture'] + " - " + horairesChargement[5]['heure_fermeture']}</span></li>
                    <li><span class="day">Dimanche :</span> <span class="time">Fermé</span></li>
        `;
        conteneur.appendChild(ligne);
    }
    chargerHoraires().catch(function (erreur) {
        console.error('Erreur lors du changement des horaires :', erreur);
    });
}