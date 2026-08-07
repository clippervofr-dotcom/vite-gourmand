<?php
require 'includes/db.php';
require 'includes/mongo-db.php';
header('Content-Type: application/json');


// Affichage via Query
// 1er argument ===>   []   === on prend tous les avis
// 2em argument ===>   ['sort' => .... === on tri selon plusieurs critères, par ordre de priorité et si égalité
// setType map === transforme en tableau

try {
    $query = new MongoDB\Driver\Query([], ['sort' => ['note' => -1, 'date-avis' => -1]]);
    $curseur = $manager->executeQuery('vite_et_gourmand.avis', $query);
    $curseur->setTypeMap(['root' => 'array', 'document' => 'array']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur de lecture données MongoDB : ' . $e->getMessage()]);
    exit;
}

$avis = [];
foreach ($curseur as $document) {
    $avis[] = [
        'utilisateur_id' => $document['utilisateur_id'],
        'commande_id' => $document['commande_id'],
        'note' => $document['note'],
        'commentaire' => $document['commentaire'],
        'date_avis' => $document['date_avis'],
    ];
}
echo json_encode(['success' => true, 'avis' => $avis]);
