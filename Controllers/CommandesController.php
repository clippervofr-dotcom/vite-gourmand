<?php
// CommandesControler.php
namespace Controllers;

use PDOException;
use Entities\Commandes;
use Interfaces\CommandesRepositoryInterface;


class CommandesController
{

    private CommandesRepositoryInterface $commandesRepository;

    public function __construct(CommandesRepositoryInterface $commandesRepository)
    {
        $this->commandesRepository = $commandesRepository;
    }

    public function getAllCommandes(): array
    {
        try {
            return $this->commandesRepository->getAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function getCommandeById(int $id): ?Commandes
    {
        try {
            return $this->commandesRepository->getById($id);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function ajouterCommande(Commandes $commande): array
    {
        try {
            $this->commandesRepository->save($commande);
            return ['success' => true, 'message' => 'Commande créée avec succès.'];
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return ['success' => false, 'message' => 'Erreur lors de la création de la commande.'];
        }
    }

    public function supprimerCommande(int $id): array
    {
        try {
            $this->commandesRepository->delete($id);
            return ['success' => true, 'message' => 'Commande supprimée avec succès.'];
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return ['success' => false, 'message' => 'Erreur lors de la suppression de la commande.'];
        }
    }

    public function findByStatut(string $statut): array
    {
        try {
            return $this->commandesRepository->findByStatut($statut);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function findByMenuId(int $menuId): array
    {
        try {
            return $this->commandesRepository->findByMenuId($menuId);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function findByDateCommande(string $dateCommande): array
    {
        try {
            return $this->commandesRepository->findByDateCommande($dateCommande);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function findByDatePrestation(string $datePrestation): array
    {
        try {
            return $this->commandesRepository->findByDatePrestation($datePrestation);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function findByPossedeAvis(bool $possedeAvis): array
    {
        try {
            return $this->commandesRepository->findByPossedeAvis($possedeAvis);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function findByNumeroCommande(string $numeroCommande): ?Commandes
    {
        try {
            return $this->commandesRepository->findByNumeroCommande($numeroCommande);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }
}

?>