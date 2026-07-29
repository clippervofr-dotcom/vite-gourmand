async function chargerItems() {
    const reponse = await fetch('panier-commande.php');
    const resultat = await reponse.json();

    if (!resultat['success']) {
        console.error(resultat['message']);
    }

    const utilisateur = resultat['info'];
    const menu = resultat['panier'];

    document.querySelector('#nom-commande').value = utilisateur['nom'];
    document.querySelector('#prenom-commande').value = utilisateur['prenom'];
    document.querySelector('#email-commande').value = utilisateur['email'];
    document.querySelector('#telephone-commande').value = utilisateur['telephone'];
    document.querySelector('#adresse-commande').value = utilisateur['adresse'];
    document.querySelector('#ville-commande').value = utilisateur['ville'];
    document.querySelector('#code-postal-commande').value = utilisateur['code_postal'];
    document.querySelector('#choix-menu').value = menu['titre'];
    document.querySelector('#nbr-personnes-commande').value = menu['quantite'];

    afficherRecapPanier(resultat);

}

function afficherRecapPanier(resultat) {
    const conteneur = document.querySelector('.commande-box-3');
    conteneur.querySelectorAll('.recap-commande-box').forEach(function (ligne) {
        ligne.remove();
    });

    console.log(resultat);

    const utilisateur = resultat['info'];
    const panier = resultat['panier'];


}

chargerItems();