<?php
require_once "includes/db.php";
require_once "includes/mongo-db.php";
header('Content-Type: application/json');

$sql = 'SELECT commande.commande_id, commande.date_commande, commande.prix_total, commande.statut, menu.titre, menu.menu_id FROM commande JOIN menu ON commande.menu_id = menu.menu_id';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);

//calcul CA TOTAL
function calculCa($commandes) {
    $montant_ca = 0;
    foreach ($commandes as $commande) {
        $montant_ca += intval($commande['prix_total']);
    }
    return $montant_ca;
}

//calcul CA par mois
function calculerCaParMois($commandes) {
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
    return $caParMois;
}

//liste menu
$liste_menu = [
    "Menu de Noël",
    "Menu de Pâques",
    "Menu Classique",
    "Menu Evenementiels",
    "Menu Végétarien"
];

//calcul commandes par titre menu
function calculCommandesParTitreMenu($commandes, $liste_menu) {
    foreach ($liste_menu as $menu) {
        $nombre_commandes = 0;
        foreach ($commandes as $commande) {
            if ($commande['titre'] === $menu) {
                $nombre_commandes++;
            }
        }
        $commandes_par_menu[] = [$menu => $nombre_commandes];
    }
    return $commandes_par_menu;
}

//calcul commande par statut 
$liste_statuts = ['en attente', 'validée', 'terminée', 'annulée'];
function calculCommandesParStatut($commandes, $liste_statuts) {
    foreach ($liste_statuts as $statut) {
        $nombre_commandes = 0;
        foreach ($commandes as $commande) {
            if ($commande['statut'] === $statut) {
                $nombre_commandes++;
            }
        }
        $commandes_par_statut[] = [$statut => $nombre_commandes];
    }
    return $commandes_par_statut;
}

//calcul taux annulation 
function tauxAnnulationCommandes($commandes) {
    if (empty($commandes)) {
        return '0%';
    }

    $nombre_commandes_annulees = 0;
    foreach ($commandes as $commande) {
        if ($commande['statut'] === 'annulée') {
            $nombre_commandes_annulees++;
        }
    }    
    $taux_annulation = ($nombre_commandes_annulees / count($commandes)) * 100;
    return round($taux_annulation, 1) . '%';
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
    'ca_total' => calculCa($commandes),
    'ca_par_mois' => calculerCaParMois($commandes),
    'commandes_par_menu' => calculCommandesParTitreMenu($commandes, $liste_menu),
    'commandes_par_statut' => calculCommandesParStatut($commandes, $liste_statuts),
    'taux_annulation' => tauxAnnulationCommandes($commandes),
    'moyenne_avis' => calculMoyenneAvis($noteAvis),
]);