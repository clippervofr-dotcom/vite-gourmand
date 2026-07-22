<?php
require 'includes/db.php';

header('Content-Type: application/json');

$conditions = [];
$params = [];

// --- Thème(s) ---
if (!empty($_GET['themes'])) {
    $themes = $_GET['themes'];
    $placeholders = implode(',', array_fill(0, count($themes), '?'));
    $conditions[] = "menu.menu_id IN (SELECT menu_id FROM menu_theme WHERE theme_id IN ($placeholders))";
    foreach ($themes as $theme) {
        $params[] = $theme;
    }
}

// --- Régime(s) ---
if (!empty($_GET['regimes'])) {
    $regimes = $_GET['regimes'];
    $placeholders = implode(',', array_fill(0, count($regimes), '?'));
    $conditions[] = "menu.menu_id IN (SELECT menu_id FROM menu_regime WHERE regime_id IN ($placeholders))";
    foreach ($regimes as $regime) {
        $params[] = $regime;
    }
}

// --- Allergène(s) à exclure ---
if (!empty($_GET['allergenes'])) {
    $allergenes = $_GET['allergenes'];
    $placeholders = implode(',', array_fill(0, count($allergenes), '?'));
    $conditions[] = "menu.menu_id NOT IN (
        SELECT menu_plat.menu_id
        FROM menu_plat
        JOIN plat_allergene ON menu_plat.plat_id = plat_allergene.plat_id
        WHERE plat_allergene.allergene_id IN ($placeholders)
    )";
    foreach ($allergenes as $allergene) {
        $params[] = $allergene;
    }
}

// --- Prix ---
if (isset($_GET['prixMin']) && isset($_GET['prixMax'])) {
    $conditions[] = "menu.prix_par_personne BETWEEN ? AND ?";
    $params[] = $_GET['prixMin'];
    $params[] = $_GET['prixMax'];
}

// --- Nombre de personnes ---
if (isset($_GET['nbrPersonnes'])) {
    $conditions[] = "menu.nombre_personne_minimum <= ?";
    $params[] = $_GET['nbrPersonnes'];
}

// --- Construction finale ---
$sql = "SELECT DISTINCT menu.*, (SELECT url FROM image_menu WHERE image_menu.menu_id = menu.menu_id LIMIT 1) AS image_url FROM menu";

if (!empty($conditions)) {
    $sql .= " WHERE " . implode(' AND ', $conditions);
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$resultats = $stmt->fetchAll();

echo json_encode($resultats);