<?php
// MenuControler.php
require_once 'bootstrap-db.php';
require_once 'bootstrap-Menu.php';
require_once 'bootstrap-Regime.php';
require_once 'bootstrap-Theme.php';
require_once 'bootstrap-Allergene.php';
require_once 'bootstrap-ImageMenu.php';

class MenuControler {
    private MenuRepositoryInterface $menuRepository;

    public function __construct(MenuRepositoryInterface $menuRepository) {
        $this->menuRepository = $menuRepository;
    }

    public function getAllMenus(): array {
        try {
            return $this->menuRepository->getAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function getMenuById(int $menuId): ?Menu {
        try {
            return $this->menuRepository->getById($menuId);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function ajouterMenu(Menu $menu): array {
        try {
            $this->menuRepository->save($menu);
            return ['succes' => true, 'message' => 'Menu créé avec succès.'];
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return ['succes' => false, 'message' => 'Une erreur est survenue lors de la creation, veuillez réessayer.'];
        }
    }

    public function supprimerMenu(int $menuId): array {
        try {
            $this->menuRepository->delete($menuId);
            return ['succes' => true, 'message' => 'Menu supprimé avec succès.'];
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return ['succes' => false, 'message' => 'Une erreur est survenue lors de la suppression, veuillez réessayer.'];
        }
    }
}
?>