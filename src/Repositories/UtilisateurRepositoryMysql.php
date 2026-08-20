<?php
// UtilisateurRepositoryMysql.php
namespace Repositories;

use Entities\Utilisateur;
use Interfaces\UtilisateurRepositoryInterface;
use PDO;

class UtilisateurRepositoryMysql implements UtilisateurRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getById(int $utilisateurId): ?Utilisateur
    {

        $sql = 'SELECT utilisateur_id, nom, prenom, email, telephone, adresse, ville, code_postal, actif, role_id FROM utilisateur WHERE utilisateur_id = :utilisateur_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':utilisateur_id', $utilisateurId, PDO::PARAM_INT);
        $stmt->execute();

        $ligne = $stmt->fetch();

        if ($ligne === false) {
            return null;
        }
        return $this->mapLigneVersUtilisateur($ligne);
    }

    public function getByEmail(string $email): ?Utilisateur
    {
        $sql = 'SELECT * FROM utilisateur WHERE email = :email';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $ligne = $stmt->fetch();
        if ($ligne === false) {
            return null;
        }
        return $this->mapLigneVersUtilisateur($ligne);
    }

    public function getByRoleId(int $roleId): ?Utilisateur
    {
        $sql = 'SELECT * FROM utilisateur WHERE role_id = :role_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':role_id', $roleId, PDO::PARAM_INT);
        $stmt->execute();

        $ligne = $stmt->fetch();
        if ($ligne === false) {
            return null;
        }
        return $this->mapLigneVersUtilisateur($ligne);
    }

    public function getAll(): array
    {
        $sql = 'SELECT * FROM utilisateur';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $resultats = $stmt->fetchAll();

        $utilisateurs = [];
        foreach ($resultats as $resultat) {
            $utilisateurs[] = $this->mapLigneVersUtilisateur($resultat);
        }
        return $utilisateurs;
    }

    public function getAllByRoleId(int $roleId): array
    {
        $sql = 'SELECT * FROM utilisateur WHERE role_id = :role_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':role_id', $roleId, PDO::PARAM_INT);
        $stmt->execute();

        $resultats = $stmt->fetchAll();

        $utilisateurs = [];
        foreach ($resultats as $resultat) {
            $utilisateurs[] = $this->mapLigneVersUtilisateur($resultat);
        }
        return $utilisateurs;
    }

    public function estActif(): array
    {
        $sql = 'SELECT utilisateur_id, nom, prenom, email, telephone, adresse, ville, code_postal, actif, role_id FROM utilisateur WHERE actif = 1 ORDER BY utilisateur_id ASC';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $resultats = $stmt->fetchAll();

        $utilisateurs = [];
        foreach ($resultats as $resultat) {
            $utilisateurs[] = $this->mapLigneVersUtilisateur($resultat);
        }
        return $utilisateurs;
    }

    public function save(Utilisateur $utilisateur): void
    {
        if ($utilisateur->getId() === null) {
            $sql = 'INSERT INTO utilisateur (nom, prenom, email, adresse, code_postal, ville, telephone, actif, role_id) VALUES (:nom, :prenom, :email, :adresse, :code_postal, :ville, :telephone, :actif, :role_id)';
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':nom', $utilisateur->getNom(), PDO::PARAM_STR);
            $stmt->bindValue(':prenom', $utilisateur->getPrenom(), PDO::PARAM_STR);
            $stmt->bindValue(':email', $utilisateur->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(':adresse', $utilisateur->getAdresse(), PDO::PARAM_STR);
            $stmt->bindValue(':code_postal', $utilisateur->getCodePostal(), PDO::PARAM_STR);
            $stmt->bindValue(':ville', $utilisateur->getVille(), PDO::PARAM_STR);
            $stmt->bindValue(':telephone', $utilisateur->getTelephone(), PDO::PARAM_STR);
            $stmt->bindValue(':actif', $utilisateur->getActif(), PDO::PARAM_BOOL);
            $stmt->bindValue(':role_id', $utilisateur->getRoleId(), PDO::PARAM_INT);
            $stmt->execute();

            $utilisateur->setId((int)$this->pdo->lastInsertId());
        } else {
            $sql = 'UPDATE utilisateur SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone, adresse = :adresse, ville = :ville, code_postal = :code_postal, actif = :actif WHERE utilisateur_id = :utilisateur_id';
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':nom', $utilisateur->getNom(), PDO::PARAM_STR);
            $stmt->bindValue(':prenom', $utilisateur->getPrenom(), PDO::PARAM_STR);
            $stmt->bindValue(':email', $utilisateur->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(':telephone', $utilisateur->getTelephone(), PDO::PARAM_STR);
            $stmt->bindValue(':adresse', $utilisateur->getAdresse(), PDO::PARAM_STR);
            $stmt->bindValue(':ville', $utilisateur->getVille(), PDO::PARAM_STR);
            $stmt->bindValue(':code_postal', $utilisateur->getCodePostal(), PDO::PARAM_STR);
            $stmt->bindValue(':actif', $utilisateur->getActif(), PDO::PARAM_BOOL);
            $stmt->bindValue(':utilisateur_id', $utilisateur->getId(), PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public function delete(int $utilisateurId): void
    {
        $sql = "DELETE FROM utilisateur WHERE utilisateur_id = :utilisateur_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':utilisateur_id', $utilisateurId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getPassword(int $utilisateurId): ?string
    {
        $sql = 'SELECT password FROM utilisateur WHERE utilisateur_id = :utilisateur_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':utilisateur_id', $utilisateurId, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            return null;
        }
        return $stmt->fetchColumn();
    }

    public function ajoutPassword(int $utilisateurId, string $password): void
    {
        $sql = 'UPDATE utilisateur SET password = :password WHERE utilisateur_id = :utilisateur_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':utilisateur_id', $utilisateurId, PDO::PARAM_INT);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
    }

    private function mapLigneVersUtilisateur(array $ligne): Utilisateur
    {
        return new Utilisateur(
            utilisateurId: $ligne['utilisateur_id'],
            nom: $ligne['nom'] ?? null,
            prenom: $ligne['prenom'] ?? null,
            email: $ligne['email'],
            telephone: $ligne['telephone'] ?? null,
            adresse: $ligne['adresse'] ?? null,
            ville: $ligne['ville'] ?? null,
            codePostal: $ligne['code_postal'] ?? null,
            actif: $ligne['actif'],
            roleId: $ligne['role_id']
        );
    }
}
