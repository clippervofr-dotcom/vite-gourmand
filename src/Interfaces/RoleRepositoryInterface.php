<?php
// RoleRepositoryInterface.php
namespace Interfaces;

use Entities\Role;

interface RoleRepositoryInterface
{
    public function getAll(): array;
    public function getById(int $roleId): ?Role;
    public function save(Role $role): void;
    public function delete(int $roleId): void;
}
