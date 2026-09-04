<?php
// UtilisateurController.php
namespace Controllers;

use Entities\Utilisateur;
use Interfaces\UtilisateurRepositoryInterface;
use PDOException;

class UtilisateurController
{
    private UtilisateurRepositoryInterface $utilisateurRepository;

    public function __construct(UtilisateurRepositoryInterface $utilisateurRepository)
    {
        $this->utilisateurRepository = $utilisateurRepository;
    }

    public function trouverUtilisateur(int $utilisateurId): ?Utilisateur
    {
        try {
            return $this->utilisateurRepository->getById($utilisateurId);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function findUtilisateurByEmail(string $email): ?Utilisateur
    {
        try {
            return $this->utilisateurRepository->getByEmail($email);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function listeUtilisateur(): array
    {
        try {
            return $this->utilisateurRepository->getAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function listeUtilisateurByRole(int $roleId): array
    {
        try {
            return $this->utilisateurRepository->getAllByRoleId($roleId);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function ajouterUtilisateur(Utilisateur $utilisateur, string $password): array
    {
        try {
            $this->utilisateurRepository->save($utilisateur, $password);
            return ['success' => true, 'message' => 'Utilisateur créé avec succès.'];
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return ['success' => false, 'message' => 'Une erreur est survenue lors de la creation/modification, veuillez réessayer.'];
        }
    }

    public function supprimerUtilisateur(int $utilisateurId): array
    {
        try {
            $this->utilisateurRepository->delete($utilisateurId);
            return ['success' => true, 'message' => 'Utilisateur supprimé avec succès.'];
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return ['success' => false, 'message' => 'Une erreur est survenue lors de la suppression, veuillez réessayer.'];
        }
    }

    public function verifPassword(int $utilisateurId, string $password): bool
    {
        try {
            $utilisateurPassword = $this->utilisateurRepository->getPassword($utilisateurId);
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
            $this->utilisateurRepository->ajoutPassword($utilisateurId, $password);
            return ['success' => true, 'message' => 'Ajout du hash avec succès.'];
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return ['success' => false, 'message' => 'Une erreur est survenue lors de l\'ajout du hash.'];
        }
    }

    public function ajouterEmployeAvecMotDePasse(Utilisateur $utilisateur): array
    {
        $motDePasse = $this->genererMotDePasseAleatoire();
        $motDePasseHache = password_hash($motDePasse, PASSWORD_DEFAULT);

        $resultatCreation = $this->ajouterUtilisateur($utilisateur, (string)$motDePasseHache);
        if (!$resultatCreation['success']) {
            error_log('Echec de l\'ajout de l\'employe.');
            return [
                'success' => false,
                'message' => 'Echec de l\'ajout de l\'employe.'
            ];
        }
        return [
            'success' => true,
            'message' => 'Employé créé avec succès.',
            'mot_de_passe' => $motDePasse
        ];
    }

    private function genererMotDePasseAleatoire(int $longueur = 12): string
    {
        $caracteres = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789!@#$%';
        $motDePasse = '';
        $max = strlen($caracteres) - 1;
        for ($i = 0; $i < $longueur; $i++) {
            $motDePasse .= $caracteres[random_int(0, $max)];
        }
        return $motDePasse;
    }
}
