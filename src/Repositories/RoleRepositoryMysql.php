<?php
// RoleRepositoryMysql.php

namespace Repositories;

use Entities\Role;
use Interfaces\RoleRepositoryInterface;
use PDO;

class RoleRepositoryMysql implements RoleRepositoryInterface
{

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getById(int $roleId): ?Role
    {
        $sql = 'SELECT * FROM role WHERE role_id = :role_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':role_id', $roleId, PDO::PARAM_INT);
        $stmt->execute();
        $ligne = $stmt->fetch();

        if ($ligne === false) {
            return null;
        }
        return $this->mapLigneVersRole($ligne);
    }

    public function getAll(): array
    {
        $sql = 'SELECT * FROM role';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $resultats = $stmt->fetchAll();

        $roles = [];
        foreach ($resultats as $resultat) {
            $roles[] = $this->mapLigneVersRole($resultat);
        }
        return $roles;
    }

    public function getAllByRole(int $roleId): array
    {
        $sql = 'SELECT * FROM role WHERE role_id = :role_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':role_id', $roleId, PDO::PARAM_INT);
        $stmt->execute();

        $resultats = $stmt->fetchAll();

        $roles = [];
        foreach ($resultats as $resultat) {
            $roles[] = $this->mapLigneVersRole($resultat);
        }
        return $roles;
    }

    public function save(Role $role): void
    {

        if ($role->getRoleId() === null) {
            $sql = 'INSERT INTO role (libelle) VALUES (:libelle)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':libelle', $role->getLibelle(), PDO::PARAM_STR);
            $stmt->execute();

            $role->setRoleId((int)$this->pdo->lastInsertId());
        } else {
            $sql = 'UPDATE role SET libelle = :libelle WHERE role_id = :role_id';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':libelle', $role->getLibelle(), PDO::PARAM_STR);
            $stmt->bindValue(':role_id', $role->getRoleId(), PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public function delete(int $roleId): void
    {
        $sql = 'DELETE FROM role WHERE role_id = :role_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':role_id', $roleId, PDO::PARAM_INT);
        $stmt->execute();
    }

    private function mapLigneVersRole(array $ligne): Role
    {
        return new Role(
            roleId: $ligne['role_id'],
            libelle: $ligne['libelle']
        );
    }
}

?>