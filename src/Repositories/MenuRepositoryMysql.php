<?php
// MenuRepositoryMysql.php

namespace Repositories;

use Entities\Menu;
use Interfaces\MenuRepositoryInterface;
use PDO;

class MenuRepositoryMysql implements MenuRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getById(int $menuId): ?Menu
    {
        $sql = 'SELECT * FROM menu WHERE menu_id = :menuId';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':menuId', $menuId, PDO::PARAM_INT);
        $stmt->execute();
        $ligne = $stmt->fetch();

        if ($ligne === false) {
            return null;
        }
        return $this->mapLigneVersMenu($ligne);
    }

    public function getAll(): array
    {
        $sql = 'SELECT * FROM menu';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $resultats = $stmt->fetchAll();

        $menus = [];
        foreach ($resultats as $resultat) {
            $menus[] = $this->mapLigneVersMenu($resultat);
        }
        return $menus;
    }

    public function save(Menu $menu): void
    {

        if ($menu->getId() === null) {
            $sql = 'INSERT INTO menu (titre, description_menu, nombre_personne_minimum, prix_par_personne, conditions, quantite_restante, actif) VALUES (:titre, :description_menu, :nombre_personne_minimum, :prix_par_personne, :conditions, :quantite_restante, :actif)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':titre', $menu->getTitre(), PDO::PARAM_STR);
            $stmt->bindValue(':description_menu', $menu->getDescriptionMenu(), PDO::PARAM_STR);
            $stmt->bindValue(':nombre_personne_minimum', $menu->getNombrePersonneMinimum(), PDO::PARAM_INT);
            $stmt->bindValue(':prix_par_personne', $menu->getPrixParPersonne(), PDO::PARAM_STR);
            $stmt->bindValue(':conditions', $menu->getConditions(), PDO::PARAM_STR);
            $stmt->bindValue(':quantite_restante', $menu->getQuantiteRestante(), PDO::PARAM_INT);
            $stmt->bindValue(':actif', $menu->getActif(), PDO::PARAM_BOOL);
            $stmt->execute();

            $menu->setId((int)$this->pdo->lastInsertId());

        } else {
            $sql = 'UPDATE menu SET titre = :titre, description_menu = :description_menu, nombre_personne_minimum = :nombre_personne_minimum, prix_par_personne = :prix_par_personne, conditions = :conditions, quantite_restante = :quantite_restante, actif = :actif WHERE menu_id = :menuId';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':titre', $menu->getTitre(), PDO::PARAM_STR);
            $stmt->bindValue(':description_menu', $menu->getDescriptionMenu(), PDO::PARAM_STR);
            $stmt->bindValue(':nombre_personne_minimum', $menu->getNombrePersonneMinimum(), PDO::PARAM_INT);
            $stmt->bindValue(':prix_par_personne', $menu->getPrixParPersonne(), PDO::PARAM_STR);
            $stmt->bindValue(':conditions', $menu->getConditions(), PDO::PARAM_STR);
            $stmt->bindValue(':quantite_restante', $menu->getQuantiteRestante(), PDO::PARAM_INT);
            $stmt->bindValue(':actif', $menu->getActif(), PDO::PARAM_BOOL);
            $stmt->bindValue(':menuId', $menu->getId(), PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public function delete(int $menuId): void
    {
        $sql = 'DELETE FROM menu WHERE menu_id = :menuId';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':menuId', $menuId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function mapLigneVersMenu(array $ligne): Menu
    {
        return new Menu(
            menuId: $ligne['menu_id'],
            titre: $ligne['titre'],
            descriptionMenu: $ligne['description_menu'],
            nombrePersonneMinimum: $ligne['nombre_personne_minimum'],
            prixParPersonne: $ligne['prix_par_personne'],
            conditions: $ligne['conditions'],
            quantiteRestante: $ligne['quantite_restante'],
            actif: $ligne['actif']
        );
    }

    public function filtrer(array $themes = [], array $regimes = [], array $allergenes = [], ?float $prixMin = null, ?float $prixMax = null, ?int $nbrPersonnes = null): array
    {
        $conditions = [];
        $params = [];

        if (!empty($themes)) {
            $placeholders = implode(',', array_fill(0, count($themes), '?'));
            $conditions[] = "menu.menu_id IN (SELECT menu_id FROM menu_theme WHERE theme_id IN ($placeholders))";
            foreach ($themes as $theme) {
                $params[] = $theme;
            }
        }

        if (!empty($regimes)) {
            $placeholders = implode(',', array_fill(0, count($regimes), '?'));
            $conditions[] = "menu.menu_id IN (SELECT menu_id FROM menu_regime WHERE regime_id IN ($placeholders))";
            foreach ($regimes as $regime) {
                $params[] = $regime;
            }
        }

        if (!empty($allergenes)) {
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

        if ($prixMin !== null && $prixMax !== null) {
            $conditions[] = "menu.prix_par_personne BETWEEN ? AND ?";
            $params[] = $prixMin;
            $params[] = $prixMax;
        }

        if ($nbrPersonnes !== null) {
            $conditions[] = "menu.nombre_personne_minimum <= ?";
            $params[] = $nbrPersonnes;
        }

        $sql = "SELECT DISTINCT menu.*, (SELECT url FROM image_menu WHERE image_menu.menu_id = menu.menu_id LIMIT 1) AS image_url FROM menu";
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }
}
