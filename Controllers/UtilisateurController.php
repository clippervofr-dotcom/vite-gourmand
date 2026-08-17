<?php
// UtilisateurController.php
namespace Controllers;

use PDOException;
use Entities\Utilisateur;
use Interfaces\UtilisateurRepositoryInterface;

class UtilisateurController
{
    private UtilisateurRepositoryInterface $UtilisateurRepository;

    public function __construct(UtilisateurRepositoryInterface $UtilisateurRepository)
    {
        $this->UtilisateurRepository = $UtilisateurRepository;
    }

    public function trouverUtilisateur(int $utilisateurId): ?Utilisateur
    {
        try {
            return $this->UtilisateurRepository->getById($utilisateurId);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function findUtilisateurByRole(int $roleId): ?Utilisateur
    {
        try {
            return $this->UtilisateurRepository->getByRoleId($roleId);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function findUtilisateurByEmail(string $email): ?Utilisateur
    {
        try {
            return $this->UtilisateurRepository->getByEmail($email);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function listeUtilisateur(): array
    {
        try {
            return $this->UtilisateurRepository->getAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function listeUtilisateurByRole(int $roleId): array
    {
        try {
            return $this->UtilisateurRepository->getAllByRoleId($roleId);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function listeUtilisateurActif(): array
    {
        try {
            return $this->UtilisateurRepository->estActif();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function ajouterUtilisateur(Utilisateur $utilisateur): array
    {
        try {
            $this->UtilisateurRepository->save($utilisateur);
            return ['success' => true, 'message' => 'Utilisateur créé avec succès.'];
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return ['success' => false, 'message' => 'Une erreur est survenue lors de la creation/modification, veuillez réessayer.'];
        }
    }

    public function supprimerUtilisateur(int $utilisateurId): array
    {
        try {
            $this->UtilisateurRepository->delete($utilisateurId);
            return ['success' => true, 'message' => 'Utilisateur supprimé avec succès.'];
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return ['success' => false, 'message' => 'Une erreur est survenue lors de la suppression, veuillez réessayer.'];
        }
    }

    public function verifPassword(int $utilisateurId, string $password): bool
    {
        try {
            $utilisateurPassword = $this->UtilisateurRepository->getPassword($utilisateurId);
            if ($utilisateurPassword === null) {
                return false;
            }
            return password_verify($password, $utilisateurPassword);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function ajouterPassword(int $utilisateurId, string $password): array
    {
        try {
            $this->UtilisateurRepository->ajoutPassword($utilisateurId, $password);
            return ['success' => true, 'message' => 'Ajout du hash avec succès.'];
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return ['success' => false, 'message' => 'Une erreur est survenue lors de l\'ajout du hash.'];
        }
    }
}
