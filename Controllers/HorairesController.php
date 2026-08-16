<?php
// HorairesControler.php
namespace Controllers;

use PDOException;
use Entities\Horaires;
use Interfaces\HorairesRepositoryInterface;

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

    public function getById(int $id): ?Horaires
    {
        try {
            return $this->horaireRepository->getById($id);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
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

    public function delete(int $id): array
    {
        try {
            $this->horaireRepository->delete($id);
            return ['success' => true, 'message' => 'Horaire supprimé avec succès.'];
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return ['success' => false, 'message' => 'Erreur lors de la suppression de l\'horaire.'];
        }
    }
}
