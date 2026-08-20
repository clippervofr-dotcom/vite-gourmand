<?php
// RegimeRepositoryMysql.php
namespace Repositories;

use Entities\Regime;
use Interfaces\RegimeRepositoryInterface;
use PDO;

class RegimeRepositoryMysql implements RegimeRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getById(int $regimeId): ?Regime
    {
        $sql = 'SELECT * FROM regime WHERE regime_id = :regimeId';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':regimeId', $regimeId, PDO::PARAM_INT);
        $stmt->execute();

        $ligne = $stmt->fetch();

        if ($ligne === false) {
            return null;
        }
        return $this->mapLigneVersRegime($ligne);
    }

    public function getAll(): array
    {
        $sql = 'SELECT * FROM regime';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $resultats = $stmt->fetchAll();

        $regimes = [];
        foreach ($resultats as $resultat) {
            $regimes[] = $this->mapLigneVersRegime($resultat);
        }
        return $regimes;
    }

    public function save(Regime $regime): void
    {
        if ($regime->getRegimeId() === null) {
            $sql = 'INSERT INTO regime (libelle) VALUES (:libelle)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':libelle', $regime->getLibelle(), PDO::PARAM_STR);
            $stmt->execute();

            $regime->setRegimeId((int)$this->pdo->lastInsertId());
        } else {
            $sql = 'UPDATE regime SET libelle = :libelle WHERE regime_id = :regimeId';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':libelle', $regime->getLibelle(), PDO::PARAM_STR);
            $stmt->bindValue(':regimeId', $regime->getRegimeId(), PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public function delete(int $regimeId): void
    {
        $sql = 'DELETE FROM regime WHERE regime_id = :regimeId';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':regimeId', $regimeId, PDO::PARAM_INT);
        $stmt->execute();
    }

    private function mapLigneVersRegime(array $ligne): Regime
    {
        return new Regime(
            regimeId: $ligne['regime_id'],
            libelle: $ligne['libelle']
        );
    }
}

?>