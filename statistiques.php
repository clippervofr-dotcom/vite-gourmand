<?php
require_once "includes/db.php";
require_once "includes/mongo-db.php";
header('Content-Type: application/json');

$sql = 'SELECT commande.commande_id, commande.date_commande, commande.prix_total, commande.statut, menu.titre, menu.menu_id FROM commande JOIN menu ON commande.menu_id = menu.menu_id';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalCommandes = $commandes;

//liste mois
$nomsMois = [
    '01' => 'Janvier',
    '02' => 'Février',
    '03' => 'Mars',
    '04' => 'Avril',
    '05' => 'Mai',
    '06' => 'Juin',
    '07' => 'Juillet',
    '08' => 'Août',
    '09' => 'Septembre',
    '10' => 'Octobre',
    '11' => 'Novembre',
    '12' => 'Décembre'
];

//liste menu
$liste_menu = [
    "Menu de Noël",
    "Menu de Pâques",
    "Menu Classique",
    "Menu Evenementiels",
    "Menu Végétarien"
];

//liste statuts
$liste_statuts = ['en attente', 'validée', 'terminée', 'annulée'];

function isValide($moisChoisi, $nomsMois) {
    if (array_key_exists($moisChoisi, $nomsMois)) {
        return $moisChoisi;
    }
    return null;
}

$moisDemande = null;
// check si la valeur GET est valide
if (isset($_GET['choix_mois'])) {
    $moisDemande = isValide($_GET['choix_mois'], $nomsMois);
}
// si oui, filtre les commandes avec le mois demandé
if ($moisDemande !== null) {
    $commandes = array_filter($commandes, function ($commande) use ($moisDemande) {
        $date = new DateTime($commande['date_commande']);
        $moisCommande = $date->format('m');
        return $moisDemande === $moisCommande;
    });
}


//calcul CA TOTAL
function calculCa($totalCommandes) {
    $montant_ca = 0;
    foreach ($totalCommandes as $commande) {
        $montant_ca += intval($commande['prix_total']);
    }
    return $montant_ca;
}

//calcul CA par mois
function calculerCaParMois($commandes, $nomsMois) {
    $caParMois = [];

    foreach ($commandes as $commande) {
        $date = new DateTime($commande['date_commande']);
        $numeroMois = $date->format('m');
        $nomMois = $nomsMois[$numeroMois];

        if (!isset($caParMois[$nomMois])) {
            $caParMois[$nomMois] = 0;
        }
        $caParMois[$nomMois] += intval($commande['prix_total']);
    }
    $caParMoisNew = [];
    foreach ($caParMois as $nomMois => $ca) {
        $caParMoisNew[] = ['nom' => $nomMois, 'prix_total' => $ca];
    }

    return $caParMoisNew;
}

//calcul commandes par titre menu

function calculCommandesParTitreMenu($commandes, $liste_menu) {
    foreach ($liste_menu as $menu) {
        $nombre_commandes = 0;
        $ca_commandes = 0;
        $compteurStatuts = ['en attente' => 0, 'validée' => 0, 'terminée' => 0, 'annulée' => 0];
        $taux_annulation_commandes = 0;
        foreach ($commandes as $commande) {
            if ($commande['titre'] === $menu) {
                $nombre_commandes++;
                $ca_commandes += intval($commande['prix_total']);
                $compteurStatuts[$commande['statut']]++;
                $taux_annulation_commandes = ($compteurStatuts['annulée'] / count($commandes)) * 100;
            }
        }
        $commandes_par_menu[] = [
            'nom_menu' => $menu,
            'nbr_commande_menu' => $nombre_commandes,
            'ca_par_commande' => $ca_commandes,
            'en_attente' => $compteurStatuts['en attente'],
            'validée' => $compteurStatuts['validée'],
            'terminée' => $compteurStatuts['terminée'],
            'annulée' => $compteurStatuts['annulée'],
            'taux_annulation' => round($taux_annulation_commandes, 1) . ' %'];
    }
    return $commandes_par_menu;
}

//calcul commande par statut 

function calculCommandesParStatut($totalCommandes, $liste_statuts) {
    foreach ($liste_statuts as $statut) {
        $nombre_commandes = 0;
        foreach ($totalCommandes as $commande) {
            if ($commande['statut'] === $statut) {
                $nombre_commandes++;
            }
        }
        $commandes_par_statut[] = ['statut' => $statut, 'nombre' => $nombre_commandes];
    }
    return $commandes_par_statut;
}

//calcul taux annulation 
function tauxAnnulationCommandes($totalCommandes) {
    if (empty($totalCommandes)) {
        return '0 %';
    }

    $nombre_commandes_annulees = 0;
    foreach ($totalCommandes as $commande) {
        if ($commande['statut'] === 'annulée') {
            $nombre_commandes_annulees++;
        }
    }    
    $taux_annulation = ($nombre_commandes_annulees / count($totalCommandes)) * 100;
    return round($taux_annulation, 1) . ' %';
}

// tableau avec que les notes 
function getNoteAvis($arrayAvis) {
    $noteAvis = [];
    foreach ($arrayAvis as $document) {
    $noteAvis[] = $document['note'];
    }
    return $noteAvis;
}

//calcul moyenne notes avis
function calculMoyenneAvis($noteAvis) {
    if (empty($noteAvis)) {
        return '0/5';
    }
    $nombre_notes = count($noteAvis);
    $somme_notes = 0;
    foreach ($noteAvis as $note) {
        $somme_notes += $note;
    }
    $moyenne = $somme_notes / $nombre_notes;
    return round($moyenne, 2) . ' / 5';
}

// fetch mongoDB avisavis
try {
    $query = new MongoDB\Driver\Query([]);
    $curseur = $manager->executeQuery('vite_et_gourmand.avis', $query);
    $curseur->setTypeMap(['root' => 'array', 'document' => 'array']);
    $arrayAvis = $curseur->toArray();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur query MongoDB : ' . $e->getMessage()]);
    exit;
}

$noteAvis = getNoteAvis($arrayAvis);

// json_encode final
echo json_encode([
    'success' => true,
    'ca_total' => calculCa($totalCommandes),
    'ca_par_mois' => calculerCaParMois($commandes, $nomsMois),
    'commandes_par_menu' => calculCommandesParTitreMenu($commandes, $liste_menu),
    'commandes_par_statut' => calculCommandesParStatut($totalCommandes, $liste_statuts),
    'taux_annulation' => tauxAnnulationCommandes($totalCommandes),
    'moyenne_avis' => calculMoyenneAvis($noteAvis),
    'mois_filtre' => $moisDemande,
]);

