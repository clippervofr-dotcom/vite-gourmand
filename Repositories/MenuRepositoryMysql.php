<?php
// MenuRepositoryMysql.php

namespace Repositories;

use PDO;
use Entities\Menu;
use Entities\Regime;
use Entities\Theme;
use Interfaces\MenuRepositoryInterface;

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

    public function getThemeByMenu(int $menuId): array
    {
        $sql = 'SELECT theme.theme_id, theme.libelle FROM theme JOIN menu_theme ON theme.theme_id = menu_theme.theme_id WHERE menu_theme.menu_id = :menuId';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':menuId', $menuId, PDO::PARAM_INT);
        $stmt->execute();

        $resultats = $stmt->fetchAll();
        $themes = [];
        foreach ($resultats as $resultat) {
            $themes[] = new Theme(
                themeId: $resultat['theme_id'],
                libelle: $resultat['libelle']
            );
        }
        return $themes;
    }

    public function getRegimeByMenu(int $menuId): array
    {
        $sql = 'SELECT regime.regime_id, regime.libelle FROM regime JOIN menu_regime ON regime.regime_id = menu_regime.regime_id WHERE menu_regime.menu_id = :menuId';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':menuId', $menuId, PDO::PARAM_INT);
        $stmt->execute();

        $resultats = $stmt->fetchAll();
        $regimes = [];
        foreach ($resultats as $resultat) {
            $regimes[] = new Regime(
                regimeId: $resultat['regime_id'],
                libelle: $resultat['libelle']
            );
        }
        return $regimes;
    }
}

?>