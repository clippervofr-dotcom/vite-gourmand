<?php
// RoleRepositoryMysql.php

class RoleRepositoryMysql implements RoleRepositoryInterface {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getById(int $id): ?Role {
        $sql = 'SELECT * FROM role WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $ligne = $stmt->fetch();

        if ($ligne === false) {
            return null;
        }
        return $this->mapLigneVersRole($ligne);
    }

    public function getAll(): array {
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

    public function save(Role $role): void {

        if ($role->getRoleId() === null) {
            $sql = 'INSERT INTO role (libelle) VALUES (:libelle)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':libelle', $role->getLibelle(), PDO::PARAM_STR);
            $stmt->execute();

            $role->setRoleId((int) $this->pdo->lastInsertId());
        } else {
            $sql = 'UPDATE role SET libelle = :libelle WHERE id = :id';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':libelle', $role->getLibelle(), PDO::PARAM_STR);
            $stmt->bindValue(':id', $role->getRoleId(), PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public function delete(int $id): void {
        $sql = 'DELETE FROM role WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    private function mapLigneVersRole(array $ligne): Role {
        return new Role(
            roleId: $ligne['role_id'],
            libelle: $ligne['libelle']
        );
    }
}
?>