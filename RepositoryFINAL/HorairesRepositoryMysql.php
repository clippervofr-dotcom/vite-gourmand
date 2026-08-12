<?php
// HorairesRepositoryMysql.php

class HorairesRepositoryMysql implements HorairesRepositoryInterface {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getById(int $id): ?Horaires {
        $sql = 'SELECT * FROM horaires WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $ligne = $stmt->fetch();

        if ($ligne === false) {
            return null;
        }
        return $this->mapLigneVersHoraires($ligne);
    }

    public function getAll(): array {
        $sql = 'SELECT * FROM horaires';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $resultats = $stmt->fetchAll();

        $horaires = [];
        foreach ($resultats as $resultat) {
            $horaires[] = $this->mapLigneVersHoraires($resultat);
        }
        return $horaires;
    }

    public function save(Horaires $horaire): void {
        if ($horaire->getId() === null) {
            $sql = 'INSERT INTO horaires (jour, debut, fin) VALUES (:jour, :debut, :fin)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':jour', $horaire->getJour(), PDO::PARAM_STR);
            $stmt->bindValue(':debut', $horaire->getDebut(), PDO::PARAM_STR);
            $stmt->bindValue(':fin', $horaire->getFin(), PDO::PARAM_STR);
            $stmt->execute();

            $horaire->setId((int) $this->pdo->lastInsertId());
        } else {
            $sql = 'UPDATE horaires SET jour = :jour, debut = :debut, fin = :fin WHERE id = :id';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':jour', $horaire->getJour(), PDO::PARAM_STR);
            $stmt->bindValue(':debut', $horaire->getDebut(), PDO::PARAM_STR);
            $stmt->bindValue(':fin', $horaire->getFin(), PDO::PARAM_STR);
            $stmt->bindValue(':id', $horaire->getId(), PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public function delete(int $id): void {

        $sql = "DELETE FROM horaires WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    private function mapLigneVersHoraires(array $ligne): Horaires {
        return new Horaires(
            id: $ligne['id'],
            jour: $ligne['jour'],
            debut: $ligne['debut'],
            fin: $ligne['fin']
        );
    }
}
?>