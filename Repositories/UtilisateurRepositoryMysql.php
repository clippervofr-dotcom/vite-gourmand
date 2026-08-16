<?php
// UtilisateurRepositoryMysql.php
namespace Repositories;

use PDO;
use Entities\Utilisateur;
use Interfaces\UtilisateurRepositoryInterface;

class UtilisateurRepositoryMysql implements UtilisateurRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getById(int $id): ?Utilisateur
    {

        $sql = 'SELECT utilisateur_id, nom, prenom, email, telephone, adresse, ville, code_postal, actif FROM utilisateur WHERE utilisateur_id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
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

    public function estActif(): array
    {
        $sql = 'SELECT utilisateur_id, nom, prenom, email, telephone, adresse, ville, code_postal, actif FROM utilisateur WHERE actif = 1 ORDER BY utilisateur_id ASC';
        $stmt = $this->pdo->query($sql);

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
            $sql = 'INSERT INTO utilisateur (nom, prenom, email, adresse, code_postal, ville, telephone, actif) VALUES (:nom, :prenom, :email, :adresse, :code_postal, :ville, :telephone, :actif)';
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':nom', $utilisateur->getNom(), PDO::PARAM_STR);
            $stmt->bindValue(':prenom', $utilisateur->getPrenom(), PDO::PARAM_STR);
            $stmt->bindValue(':email', $utilisateur->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(':adresse', $utilisateur->getAdresse(), PDO::PARAM_STR);
            $stmt->bindValue(':code_postal', $utilisateur->getCodePostal(), PDO::PARAM_STR);
            $stmt->bindValue(':ville', $utilisateur->getVille(), PDO::PARAM_STR);
            $stmt->bindValue(':telephone', $utilisateur->getTelephone(), PDO::PARAM_STR);
            $stmt->bindValue(':actif', $utilisateur->getActif(), PDO::PARAM_BOOL);

            $stmt->execute();

            $utilisateur->setId((int)$this->pdo->lastInsertId());
        } else {
            $sql = 'UPDATE utilisateur SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone, adresse = :adresse, ville = :ville, code_postal = :code_postal, actif = :actif WHERE utilisateur_id = :id';
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':nom', $utilisateur->getNom(), PDO::PARAM_STR);
            $stmt->bindValue(':prenom', $utilisateur->getPrenom(), PDO::PARAM_STR);
            $stmt->bindValue(':email', $utilisateur->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(':telephone', $utilisateur->getTelephone(), PDO::PARAM_STR);
            $stmt->bindValue(':adresse', $utilisateur->getAdresse(), PDO::PARAM_STR);
            $stmt->bindValue(':ville', $utilisateur->getVille(), PDO::PARAM_STR);
            $stmt->bindValue(':code_postal', $utilisateur->getCodePostal(), PDO::PARAM_STR);
            $stmt->bindValue(':actif', $utilisateur->getActif(), PDO::PARAM_BOOL);
            $stmt->bindValue(':id', $utilisateur->getId(), PDO::PARAM_INT);

            $stmt->execute();
        }
    }

    public function delete(int $id): void
    {
        $sql = "DELETE FROM utilisateur WHERE utilisateur_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    private function mapLigneVersUtilisateur(array $ligne): Utilisateur
    {
        return new Utilisateur(
            id: $ligne['utilisateur_id'],
            nom: $ligne['nom'],
            prenom: $ligne['prenom'],
            email: $ligne['email'],
            telephone: $ligne['telephone'],
            adresse: $ligne['adresse'],
            ville: $ligne['ville'],
            codePostal: $ligne['code_postal'],
            actif: $ligne['actif']
        );
    }
}

?>