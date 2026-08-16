<?php
// MenuControler.php
namespace Controllers;

use PDOException;
use Entities\Menu;
use Interfaces\MenuRepositoryInterface;



class MenuController
{
    private MenuRepositoryInterface $menuRepository;

    public function __construct(MenuRepositoryInterface $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function getAllMenus(): array
    {
        try {
            return $this->menuRepository->getAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function getMenuById(int $menuId): ?Menu
    {
        try {
            return $this->menuRepository->getById($menuId);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function ajouterMenu(Menu $menu): array
    {
        try {
            $this->menuRepository->save($menu);
            return ['success' => true, 'message' => 'Menu créé avec succès.'];
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return ['success' => false, 'message' => 'Une erreur est survenue lors de la creation, veuillez réessayer.'];
        }
    }

    public function supprimerMenu(int $menuId): array
    {
        try {
            $this->menuRepository->delete($menuId);
            return ['success' => true, 'message' => 'Menu supprimé avec succès.'];
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return ['success' => false, 'message' => 'Une erreur est survenue lors de la suppression, veuillez réessayer.'];
        }
    }
}
