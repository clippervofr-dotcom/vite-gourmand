<?php
require 'includes/db.php';

header('Content-Type: application/json');

$menuId = 1;
$quantite = 20;

$menu = $pdo->prepare("SELECT menu.*, image_menu.url AS image_url FROM menu JOIN image_menu ON menu.menu_id = image_menu.menu_id WHERE menu.menu_id = ?");
$menu->execute([$menuId]);
$resultats = $menu->fetch();

$resultats['quantite'] = $quantite;
$resultats['prix_total'] = $resultats['prix_par_personne'] * $quantite;

echo json_encode($resultats);