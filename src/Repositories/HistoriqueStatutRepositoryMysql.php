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
}
