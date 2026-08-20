<?php
// RoleController.php
namespace Controllers;

use Interfaces\RoleRepositoryInterface;
use PDOException;


class RoleController {

    private RoleRepositoryInterface $roleRepository;
    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->RoleRepository = $RoleRepository;
    }
    public function getAllByRole(int $roleId): array
    {
        try {
            return $this->RoleRepository->getAllByRole($roleId);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
}
