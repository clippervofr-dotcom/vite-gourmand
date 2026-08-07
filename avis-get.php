<?php
require 'includes/db.php';
require 'includes/mongo-db.php';
header('Content-Type: application/json');


// Affichage via Query
// 1er argument ===>   []   === on prend tous les avis
// 2em argument ===>   ['sort' => .... === on tri selon plusieurs critères, par ordre de priorité et si égalité
// setTypeMap === transforme objets en tableau

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
    $utilisateurId = $document['utilisateur_id'];
    $stmt = $pdo->prepare('SELECT nom, prenom FROM utilisateur WHERE utilisateur_id = ?');
    $stmt->execute([$utilisateurId]);
    $utilisateurInfos = $stmt->fetch();

    $avis[] = [
        'utilisateur_id' => $document['utilisateur_id'],
        'commande_id' => $document['commande_id'],
        'note' => $document['note'],
        'commentaire' => $document['commentaire'],
        'date_avis' => $document['date_avis'],
        'nom' => $utilisateurInfos['nom'] ?? 'Doe',
        'prenom' => $utilisateurInfos['prenom'] ?? 'John',
    ];
}
echo json_encode(['success' => true, 'avis' => $avis]);
