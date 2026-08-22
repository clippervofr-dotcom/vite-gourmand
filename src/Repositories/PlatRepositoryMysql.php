<?php
// PlatRepositoryMysql.php
namespace Repositories;

use Entities\Allergene;
use Entities\Plat;
use Interfaces\PlatRepositoryInterface;
use PDO;

class PlatRepositoryMysql implements PlatRepositoryInterface {

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getPlatById(int $platId): ?Plat {
        $sql = 'SELECT * FROM plat WHERE plat_id = :plat_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':plat_id', $platId, PDO::PARAM_INT);
        $stmt->execute();
        $ligne = $stmt->fetch();

        if ($ligne === false) {
            return null;
        }
        return $this->mapLigneVersPlat($ligne);
    }

    public function getAll(): array
    {

        $sql = 'SELECT * FROM plat';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $resultats = $stmt->fetchAll();

        $plats = [];
        foreach ($resultats as $resultat) {
            $plats[] = $this->mapLigneVersPlat($resultat);
        }
        return $plats;
    }

    public function getByType(string $typePlat): array
    {
        $sql = 'SELECT * FROM plat WHERE type_plat = :type_plat';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':type_plat', $typePlat, PDO::PARAM_STR);
        $stmt->execute();

        $resultats = $stmt->fetchAll();

        $plats = [];
        foreach ($resultats as $resultat) {
            $plats[] = $this->mapLigneVersPlat($resultat);
        }
        return $plats;
    }

    /** // lecture IDE
     * @return Allergene[]
     */
    public function getAllergeneByPlatId(int $platId): ?array
    {
        $sql = 'SELECT allergene.allergene_id, allergene.libelle FROM allergene JOIN plat_allergene ON allergene.allergene_id = plat_allergene.allergene_id WHERE plat_allergene.plat_id = :plat_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':plat_id', $platId, PDO::PARAM_INT);
        $stmt->execute();

        $resultats = $stmt->fetchAll();

        $allergenes = [];
        foreach ($resultats as $resultat) {
            $allergenes[] = new Allergene(
                allergeneId: $resultat['allergene_id'],
                libelle: $resultat['libelle']
            );
        }
        return $allergenes;
    }

    public function getPlatByMenuId(int $menuId): array
    {
        $sql = 'SELECT plat.* FROM plat JOIN menu_plat ON plat.plat_id = menu_plat.plat_id WHERE menu_plat.menu_id = :menu_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':menu_id', $menuId, PDO::PARAM_INT);
        $stmt->execute();

        $resultats = $stmt->fetchAll();

        $plats = [];
        foreach ($resultats as $resultat) {
            $plats[] = $this->mapLigneVersPlat($resultat);
        }
        return $plats;
    }

    public function getPlatByAllergeneId(int $allergeneId): array
    {
        $sql = 'SELECT plat.* FROM plat JOIN plat_allergene ON plat.plat_id = plat_allergene.plat_id WHERE plat_allergene.allergene_id = :allergene_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':allergene_id', $allergeneId, PDO::PARAM_INT);
        $stmt->execute();

        $resultats = $stmt->fetchAll();

        $plats = [];
        foreach ($resultats as $resultat) {
            $plats[] = $this->mapLigneVersPlat($resultat);
        }
        return $plats;
    }

    public function save(Plat $plat): void
    {
        if ($plat->getPlatId() === null) {
            $sql = 'INSERT INTO plat (nom, type_plat, description_plat, photo) VALUES (:nom, :type_plat, :description_plat, :photo)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':nom', $plat->getNom(), PDO::PARAM_STR);
            $stmt->bindValue(':type_plat', $plat->getTypePlat(), PDO::PARAM_STR);
            $stmt->bindValue(':description_plat', $plat->getDescriptionPlat(), PDO::PARAM_STR);
            $stmt->bindValue(':photo', $plat->getPhoto(), PDO::PARAM_STR);
            $stmt->execute();
        } else {
            $sql = 'UPDATE plat SET nom = :nom, type_plat = :type_plat, description_plat = :description_plat, photo = :photo WHERE plat_id = :plat_id';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':nom', $plat->getNom(), PDO::PARAM_STR);
            $stmt->bindValue(':type_plat', $plat->getTypePlat(), PDO::PARAM_STR);
            $stmt->bindValue(':description_plat', $plat->getDescriptionPlat(), PDO::PARAM_STR);
            $stmt->bindValue(':photo', $plat->getPhoto(), PDO::PARAM_STR);
            $stmt->bindValue(':plat_id', $plat->getPlatId(), PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public function delete(int $platId): void
    {
        $sql = 'DELETE FROM plat WHERE plat_id = :plat_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':plat_id', $platId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function mapLigneVersPlat(array $ligne): Plat
    {
        return new Plat(
            $ligne['plat_id'],
            $ligne['nom'],
            $ligne['type_plat'],
            $ligne['description_plat'],
            $ligne['photo']
        );
    }
}