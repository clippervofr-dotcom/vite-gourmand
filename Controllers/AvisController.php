<?php

namespace Controllers;

use Exception;
use Entities\Avis;
use Interfaces\AvisRepositoryInterface;
use Interfaces\CommandesRepositoryInterface;

class AvisController
{

    private AvisRepositoryInterface $avisRepository;

    private CommandesRepositoryInterface $commandesRepository;

    public function __construct(AvisRepositoryInterface $avisRepository, CommandesRepositoryInterface $commandesRepository)
    {
        $this->avisRepository = $avisRepository;
        $this->commandesRepository = $commandesRepository;
    }

    public function getAllAvis(): array
    {
        try {
            return $this->avisRepository->getAll();
        } catch (Exception $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function getAvisByNote(int $note): array
    {
        try {
            return $this->avisRepository->getByNote($note);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function getAvisByUtilisateurId(int $utilisateurId): array
    {
        try {
            return $this->avisRepository->getByUtilisateurId($utilisateurId);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function getAvisByDateAvis(string $dateAvis): array
    {
        try {
            return $this->avisRepository->getByDateAvis($dateAvis);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function getAvisByCommandeId(int $commandeId): array
    {
        try {
            return $this->avisRepository->getByCommandeId($commandeId);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function supprimerAvis(int $commandeId): array
    {
        $commande = $this->commandesRepository->getById($commandeId);
        if (!$commande) {
            return ['success' => false, 'message' => 'Commande introuvable.'];
        } else if (!$commande->getPossedeAvis()) {
            return ['success' => false, 'message' => 'Aucun avis n\'existe pour cette commande.'];
        } else {
            try {
                $this->avisRepository->delete($commandeId);
                $commande->setPossedeAvis(false);
                $this->commandesRepository->save($commande);
                return ['success' => true, 'message' => 'Avis supprimé avec succès.'];
            } catch (Exception $e) {
                error_log($e->getMessage());
                return ['success' => false, 'message' => 'Erreur lors de la suppression de l\'avis.'];
            }
        }
    }

    public function ajouterAvis(Avis $avis): array
    {
        $commande = $this->commandesRepository->getById($avis->getCommandeId());
        if (!$commande) {
            return ['success' => false, 'message' => 'Commande introuvable.'];
        } else if ($commande->getPossedeAvis()) {
            return ['success' => false, 'message' => 'Un avis existe déjà pour cette commande.'];
        } else {
            try {
                $this->avisRepository->save($avis);
                $commande->setPossedeAvis(true);
                $this->commandesRepository->save($commande);
                return ['success' => true, 'message' => 'Avis créé avec succès.'];
            } catch (Exception $e) {
                error_log($e->getMessage());
                return ['success' => false, 'message' => 'Erreur lors de la création de l\'avis.'];
            }
        }
    }
}
