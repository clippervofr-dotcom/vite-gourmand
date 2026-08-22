<?php
// PlatController.php

namespace Controllers;

use Entities\Plat;
use Interfaces\PlatRepositoryInterface;
use PDOException;

class PlatController
{
    private PlatRepositoryInterface $platRepository;

    public function __construct(PlatRepositoryInterface $platRepository)
    {
        $this->platRepository = $platRepository;
    }

    public function getAllPlats(): array
    {
        try {
            return $this->platRepository->getAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function getPlatById(int $platId): ?Plat
    {
        try {
            return $this->platRepository->getPlatById($platId);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function getPlatsByType(string $typePlat): array
    {
        try {
            return $this->platRepository->getByType($typePlat);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function getPlatsByMenuId(int $menuId): array
    {
        try {
            return $this->platRepository->getPlatByMenuId($menuId);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function getAllergenesByPlatId(int $platId): ?array
    {
        try {
            return $this->platRepository->getAllergeneByPlatId($platId);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function ajoutModifPlat(Plat $plat): array
    {
        try {
            $this->platRepository->save($plat);
            return ['success' => true, 'message' => 'Plat créé avec succès.'];
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return ['success' => false, 'message' => 'Une erreur est survenue lors de la creation, veuillez réessayer.'];
        }
    }

    public function supprimerPlat(int $platId): array
    {
        try {
            $this->platRepository->delete($platId);
            return ['success' => true, 'message' => 'Plat supprimé avec succès.'];
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return ['success' => false, 'message' => 'Une erreur est survenue lors de la suppression, veuillez réessayer.'];
        }
    }
}

