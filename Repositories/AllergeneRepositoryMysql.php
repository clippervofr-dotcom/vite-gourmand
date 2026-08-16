<?php
// AllergeneRepositoryMysql.php
namespace Repositories;

use PDO;
use Entities\Allergene;
use Interfaces\AllergeneRepositoryInterface;

class AllergeneRepositoryMysql implements AllergeneRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getById(int $allergeneId): ?Allergene
    {
        $sql = 'SELECT * FROM allergene WHERE allergene_id = :allergeneId';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':allergeneId', $allergeneId, PDO::PARAM_INT);
        $stmt->execute();

        $ligne = $stmt->fetch();

        if ($ligne === false) {
            return null;
        }
        return $this->mapLigneVersAllergene($ligne);
    }

    public function getAll(): array
    {
        $sql = 'SELECT * FROM allergene';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $resultats = $stmt->fetchAll();

        $allergenes = [];
        foreach ($resultats as $resultat) {
            $allergenes[] = $this->mapLigneVersAllergene($resultat);
        }
        return $allergenes;
    }

    public function save(Allergene $allergene): void
    {
        if ($allergene->getAllergeneId() === null) {
            $sql = 'INSERT INTO allergene (libelle) VALUES (:libelle)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':libelle', $allergene->getLibelle(), PDO::PARAM_STR);
            $stmt->execute();

            $allergene->setAllergeneId((int)$this->pdo->lastInsertId());
        } else {
            $sql = 'UPDATE allergene SET libelle = :libelle WHERE allergene_id = :allergeneId';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':libelle', $allergene->getLibelle(), PDO::PARAM_STR);
            $stmt->bindValue(':allergeneId', $allergene->getAllergeneId(), PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public function delete(int $allergeneId): void
    {
        $sql = 'DELETE FROM allergene WHERE allergene_id = :allergeneId';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':allergeneId', $allergeneId, PDO::PARAM_INT);
        $stmt->execute();
    }

    private function mapLigneVersAllergene(array $ligne): Allergene
    {
        return new Allergene(
            allergeneId: $ligne['allergene_id'],
            libelle: $ligne['libelle']
        );
    }
}

?>