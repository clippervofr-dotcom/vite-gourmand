<?php
// HorairesControler.php
namespace Controllers;

use Entities\Horaires;
use Interfaces\HorairesRepositoryInterface;
use PDOException;

class HorairesController
{
    private HorairesRepositoryInterface $horaireRepository;

    public function __construct(HorairesRepositoryInterface $horaireRepository)
    {
        $this->horaireRepository = $horaireRepository;
    }

    public function getAll(): array
    {
        try {
            return $this->horaireRepository->getAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function getById(int $horaireId): ?Horaires
    {
        try {
            return $this->horaireRepository->getById($horaireId);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function getByOrderedId(): array
    {
        try {
            return $this->horaireRepository->getByOrderedId();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function save(Horaires $horaire): array
    {
        try {
            $this->horaireRepository->save($horaire);
            return ['success' => true, 'message' => 'Horaire enregistré avec succès.'];
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return ['success' => false, 'message' => 'Erreur lors de l\'enregistrement de l\'horaire.'];
        }
    }

    public function delete(int $horaireId): array
    {
        try {
            $this->horaireRepository->delete($horaireId);
            return ['success' => true, 'message' => 'Horaire supprimé avec succès.'];
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return ['success' => false, 'message' => 'Erreur lors de la suppression de l\'horaire.'];
        }
    }
}
