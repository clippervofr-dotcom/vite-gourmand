<?php
// RoleController.php
namespace Controllers;

use PDOException;
use Entities\Role;
use Interfaces\RoleRepositoryInterface;


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
