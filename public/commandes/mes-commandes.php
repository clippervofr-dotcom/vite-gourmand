<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../src/Config/bootstrap.php';
require_once ROOT_PATH . '/src/Config/session.php';
require ROOT_PATH . '/src/Security/csrf.php';

use Controllers\CommandesController;
use Repositories\CommandesRepositoryMysql;
use Repositories\HistoriqueStatutRepositoryMysql;
use Repositories\MenuRepositoryMysql;

header('Content-Type: application/json');

if (!isset($_SESSION['utilisateur'])) {
    echo json_encode(['success' => false, 'message' => 'Probleme d\'identification']);
    exit;
}

$utilisateurId = $_SESSION['utilisateur']['utilisateur_id'] ?? null;

$historiqueStatutRepository = new HistoriqueStatutRepositoryMysql($pdo);
$commandesRepository = new CommandesRepositoryMysql($pdo, $historiqueStatutRepository);
$commandesController = new CommandesController($commandesRepository);
$menuRepository = new MenuRepositoryMysql($pdo);

$commandes = $commandesController->findByUtilisateurId((int)$utilisateurId);

$commandesAndTitreMenu = [];
foreach ($commandes as $commande) {
    $menu = $menuRepository->getById($commande->getMenuId());
    if (!$menu) {
        error_log('Menu introuvable pour la commande ID: ' . $commande->getCommandeId());
    }
    $commandesAndTitreMenu[] = [
        'commande_id' => $commande->getCommandeId(),
        'numero_commande' => $commande->getNumeroCommande(),
        'utilisateur_id' => $commande->getUtilisateurId(),
        'menu_id' => $commande->getMenuId(),
        'titre' => $menu ? $menu->getTitre() : null,
        'statut' => $commande->getStatut(),
        'date_commande' => $commande->getDateCommande(),
        'date_prestation' => $commande->getDatePrestation(),
        'heure_prestation' => $commande->getHeurePrestation(),
        'adresse_livraison' => $commande->getAdresseLivraison(),
        'nombre_personnes' => $commande->getNombrePersonnes(),
        'prix_menu' => $commande->getPrixMenu(),
        'prix_total' => $commande->getPrixTotal(),
        'prix_livraison' => $commande->getPrixLivraison(),
        'possede_avis' => $commande->getPossedeAvis(),
        'pret_materiel' => $commande->getPretMateriel(),
        'rendu_materiel' => $commande->getRenduMateriel(),
        'motif_annulation' => $commande->getMotifAnnulation(),
        'mode_contact_annulation' => $commande->getModeContactAnnulation(),
    ];
}
echo json_encode($commandesAndTitreMenu);
