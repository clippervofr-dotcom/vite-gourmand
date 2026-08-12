<?php
// UtilisateurController.php
class UtilisateurController {
    private UtilisateurRepositoryInterface $UtilisateurRepository;

    public function __construct(UtilisateurRepositoryInterface $UtilisateurRepository) {
        $this->UtilisateurRepository = $UtilisateurRepository;
    }

    public function trouverUtilisateur(int $id): ?Utilisateur {
        try {
            return $this->UtilisateurRepository->getById($id);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function listeUtilisateur() : array {
        try {
            return $this->UtilisateurRepository->getAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function listeUtilisateurActif() : array {
        try {
            return $this->UtilisateurRepository->estActif();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function ajouterUtilisateur(Utilisateur $utilisateur): array {
        try {
            $this->UtilisateurRepository->save($utilisateur);
            return ['succes' => true, 'message' => 'Utilisateur créé avec succès.'];
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return ['succes' => false, 'message' => 'Une erreur est survenue lors de la creation/modification, veuillez réessayer.'];
        }
    }

    public function supprimerUtilisateur(int $id) {
        try {
            $this->UtilisateurRepository->delete($id);
            return ['succes' => true, 'message' => 'Utilisateur supprimé avec succès.'];
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return ['succes' => false, 'message' => 'Une erreur est survenue lors de la suppression, veuillez réessayer.'];
        }
    }
}
?>