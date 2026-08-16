<?php
// HorairesRepositoryMysql.php

namespace Repositories;

use PDO;
use Entities\Horaires;
use Interfaces\HorairesRepositoryInterface;

class HorairesRepositoryMysql implements HorairesRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getById(int $horaireId): ?Horaires
    {
        $sql = 'SELECT * FROM horaire WHERE horaire_id = :horaire_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':horaire_id', $horaireId, PDO::PARAM_INT);
        $stmt->execute();

        $ligne = $stmt->fetch();

        if ($ligne === false) {
            return null;
        }
        return $this->mapLigneVersHoraires($ligne);
    }

    public function getAll(): array
    {
        $sql = 'SELECT * FROM horaire';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $resultats = $stmt->fetchAll();

        $horaires = [];
        foreach ($resultats as $resultat) {
            $horaires[] = $this->mapLigneVersHoraires($resultat);
        }
        return $horaires;
    }

    public function save(Horaires $horaire): void
    {
        if ($horaire->getHoraireId() === null) {
            $sql = 'INSERT INTO horaire (jour, heure_ouverture, heure_fermeture) VALUES (:jour, :heure_ouverture, :heure_fermeture)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':jour', $horaire->getJour(), PDO::PARAM_STR);
            $stmt->bindValue(':heure_ouverture', $horaire->getHeureOuverture(), PDO::PARAM_STR);
            $stmt->bindValue(':heure_fermeture', $horaire->getHeureFermeture(), PDO::PARAM_STR);
            $stmt->execute();

            $horaire->setHoraireId((int)$this->pdo->lastInsertId());
        } else {
            $sql = 'UPDATE horaire SET jour = :jour, heure_ouverture = :heure_ouverture, heure_fermeture = :heure_fermeture WHERE horaire_id = :horaire_id';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':jour', $horaire->getJour(), PDO::PARAM_STR);
            $stmt->bindValue(':heure_ouverture', $horaire->getHeureOuverture(), PDO::PARAM_STR);
            $stmt->bindValue(':heure_fermeture', $horaire->getHeureFermeture(), PDO::PARAM_STR);
            $stmt->bindValue(':horaire_id', $horaire->getHoraireId(), PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public function delete(int $horaireId): void
    {

        $sql = "DELETE FROM horaire WHERE horaire_id = :horaire_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':horaire_id', $horaireId, PDO::PARAM_INT);
        $stmt->execute();
    }

    private function mapLigneVersHoraires(array $ligne): Horaires
    {
        return new Horaires(
            horaireId: (int) $ligne['horaire_id'],
            jour: $ligne['jour'],
            heureOuverture: $ligne['heure_ouverture'],
            heureFermeture: $ligne['heure_fermeture']
        );
    }
}