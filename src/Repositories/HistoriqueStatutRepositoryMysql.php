<?php
// HistoriqueStatutRepositoryMysql.php
namespace Repositories;

use Entities\HistoriqueStatut;
use Interfaces\HistoriqueStatutRepositoryInterface;
use PDO;

class HistoriqueStatutRepositoryMysql implements HistoriqueStatutRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getById(int $historiqueStatutId): ?HistoriqueStatut
    {
        $sql = 'SELECT * FROM historique_statut WHERE historique_id = :historique_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':historique_id', $historiqueStatutId, PDO::PARAM_INT);
        $stmt->execute();
        $ligne = $stmt->fetch();
        if ($ligne === false) {
            return null;
        }
        return $this->mapLigneVersHistoriqueStatut($ligne);
    }

    public function getAll(): array
    {
        $sql = 'SELECT * FROM historique_statut';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $resultats = $stmt->fetchAll();
        $historiqueStatuts = [];
        foreach ($resultats as $resultat) {
            $historiqueStatuts[] = $this->mapLigneVersHistoriqueStatut($resultat);
        }
        return $historiqueStatuts;
    }

    public function save(HistoriqueStatut $historiqueStatut): void
    {
        if ($historiqueStatut->getHistoriqueStatutId() === null) {
            $sql = 'INSERT INTO historique_statut (commande_id, statut, date_changement) VALUES (:commande_id, :statut, :date_changement)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':commande_id', $historiqueStatut->getCommandeId(), PDO::PARAM_INT);
            $stmt->bindValue(':statut', $historiqueStatut->getStatut(), PDO::PARAM_STR);
            $stmt->bindValue(':date_changement', $historiqueStatut->getDateChangementStatut(), PDO::PARAM_STR);
            $stmt->execute();

            $historiqueStatut->setHistoriqueStatutId((int)$this->pdo->lastInsertId());
        } else {
            $sql = 'UPDATE historique_statut SET commande_id = :commande_id, statut = :statut, date_changement = :date_changement WHERE historique_id = :historique_id';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':commande_id', $historiqueStatut->getCommandeId(), PDO::PARAM_INT);
            $stmt->bindValue(':statut', $historiqueStatut->getStatut(), PDO::PARAM_STR);
            $stmt->bindValue(':date_changement', $historiqueStatut->getDateChangementStatut(), PDO::PARAM_STR);
            $stmt->bindValue(':historique_id', $historiqueStatut->getHistoriqueStatutId(), PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public function delete(int $historiqueStatutId): void
    {
        $sql = 'DELETE FROM historique_statut WHERE historique_id = :historique_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':historique_id', $historiqueStatutId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function findByCommandeId(int $commandeId): array
    {
        $sql = 'SELECT * FROM historique_statut WHERE commande_id = :commande_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':commande_id', $commandeId, PDO::PARAM_INT);
        $stmt->execute();
        $resultats = $stmt->fetchAll();
        $historiqueStatuts = [];
        foreach ($resultats as $resultat) {
            $historiqueStatuts[] = $this->mapLigneVersHistoriqueStatut($resultat);
        }
        return $historiqueStatuts;
    }

    public function findByStatut(string $statut): array
    {
        $sql = 'SELECT * FROM historique_statut WHERE statut = :statut';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':statut', $statut, PDO::PARAM_STR);
        $stmt->execute();
        $resultats = $stmt->fetchAll();
        $historiqueStatuts = [];
        foreach ($resultats as $resultat) {
            $historiqueStatuts[] = $this->mapLigneVersHistoriqueStatut($resultat);
        }
        return $historiqueStatuts;
    }

    public function findByDateChangementStatut(string $dateChangementStatut): array
    {
        $sql = 'SELECT * FROM historique_statut WHERE date_changement = :date_changement';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':date_changement', $dateChangementStatut, PDO::PARAM_STR);
        $stmt->execute();
        $resultats = $stmt->fetchAll();
        $historiqueStatuts = [];
        foreach ($resultats as $resultat) {
            $historiqueStatuts[] = $this->mapLigneVersHistoriqueStatut($resultat);
        }
        return $historiqueStatuts;
    }

    private function mapLigneVersHistoriqueStatut(array $ligne): HistoriqueStatut
    {
        return new HistoriqueStatut(
            historiqueStatutId: $ligne['historique_id'],
            commandeId: $ligne['commande_id'],
            statut: $ligne['statut'],
            dateChangementStatut: $ligne['date_changement']
        );
    }
}

?>