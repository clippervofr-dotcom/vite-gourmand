<?php
session_start();

use Controllers\CommandesController;
use Controllers\MenuController;
use Controllers\UtilisateurController;
use includes\Autoloader;
use Repositories\CommandesRepositoryMysql;
use Repositories\HistoriqueStatutRepositoryMysql;
use Repositories\MenuRepositoryMysql;
use Repositories\UtilisateurRepositoryMysql;

require __DIR__ . '/includes/Autoloader.php';
require __DIR__ . '/Bootstraps/bootstrap-db.php';
Autoloader::register();
header('Content-Type: application/json');

if (!isset($_SESSION['utilisateur'])) {
    echo json_encode(['success' => false, 'message' => 'Non connecté.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée.']);
    exit;
}

if (!in_array($_SESSION['utilisateur']['role_id'], [2, 3])) {
    echo json_encode(['success' => false, 'message' => 'Authorisation insuffisante.']);
    exit;
}

$commandeId = $_POST['commande_id'] ?? null;

$utilisateurRepository = new UtilisateurRepositoryMysql($pdo);
$utilisateurController = new UtilisateurController($utilisateurRepository);
$historiqueStatutRepository = new HistoriqueStatutRepositoryMysql($pdo);
$commandesRepository = new CommandesRepositoryMysql($pdo, $historiqueStatutRepository);
$commandesController = new CommandesController($commandesRepository);
$menuRepository = new MenuRepositoryMysql($pdo);
$menuController = new MenuController($menuRepository);

if ($commandeId !== null) {
    $commandes = $commandesController->getCommandeById((int)$commandeId);
    if (!$commandes) {
        error_log('Commande introuvable pour l\'ID: ' . $commandeId);
        echo json_encode(['success' => false, 'message' => 'Commande introuvable.']);
        exit;
    }

    $utilisateur = $utilisateurController->trouverUtilisateur($commandes->getUtilisateurId());
    if (!$utilisateur) {
        error_log('Utilisateur introuvable pour la commande ID: ' . $commandes->getCommandeId());
        echo json_encode(['success' => false, 'message' => 'Utilisateur introuvable.']);
        exit;
    }

    $menu = $menuController->getMenuById($commandes->getMenuId());
    if (!$menu) {
        error_log('Menu introuvable pour la commande ID: ' . $commandes->getCommandeId());
    }
    $commandes = [
        'commande_id' => $commandes->getCommandeId(),
        'numero_commande' => $commandes->getNumeroCommande(),
        'utilisateur_id' => $commandes->getUtilisateurId(),
        'menu_id' => $commandes->getMenuId(),
        'statut' => $commandes->getStatut(),
        'date_commande' => $commandes->getDateCommande(),
        'date_prestation' => $commandes->getDatePrestation(),
        'heure_prestation' => $commandes->getHeurePrestation(),
        'adresse_livraison' => $commandes->getAdresseLivraison(),
        'nombre_personnes' => $commandes->getNombrePersonnes(),
        'prix_menu' => $commandes->getPrixMenu(),
        'prix_total' => $commandes->getPrixTotal(),
        'prix_livraison' => $commandes->getPrixLivraison(),
        'motif_annulation' => $commandes->getMotifAnnulation(),
        'mode_contact_annulation' => $commandes->getModeContactAnnulation(),
        'pret_materiel' => $commandes->getPretMateriel(),
        'rendu_materiel' => $commandes->getRenduMateriel(),
        'possede_avis' => $commandes->getPossedeAvis(),
        'utilisateur_nom' => $utilisateur->getNom(),
        'utilisateur_prenom' => $utilisateur->getPrenom(),
        'utilisateur_email' => $utilisateur->getEmail(),
        'utilisateur_telephone' => $utilisateur->getTelephone(),
        'titre' => $menu ? $menu->getTitre() : null,
    ];

    $commandesDetails = [
        'success' => true,
        'commande' => $commandes
    ];

    echo json_encode($commandesDetails);
} else {
    echo json_encode(['success' => false, 'message' => 'ID de commande manquant.']);
}








