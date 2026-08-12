<?php
// RoleRepositoryInterface.php
interface RoleRepositoryInterface {
    public function getById(int $id): ?Role;
    public function getAll(): array;
    public function save(Role $role): void;
    public function delete(int $id): void;
}
?>