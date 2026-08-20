<?php
// ImageMenuRepositoryMysql.php
namespace Repositories;

use Entities\ImageMenu;
use Interfaces\ImageMenuRepositoryInterface;
use PDO;

class ImageMenuRepositoryMysql implements ImageMenuRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getByImageId(int $imageId): ?ImageMenu
    {
        $sql = 'SELECT * FROM image_menu WHERE image_id = :image_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':image_id', $imageId, PDO::PARAM_INT);
        $stmt->execute();

        $ligne = $stmt->fetch();

        if ($ligne === false) {
            return null;
        }
        return $this->mapLigneVersImageMenu($ligne);
    }

    public function getByMenuId(int $menuId): ?ImageMenu
    {
        $sql = 'SELECT * FROM image_menu WHERE menu_id = :menu_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':menu_id', $menuId, PDO::PARAM_INT);
        $stmt->execute();

        $ligne = $stmt->fetch();

        if ($ligne === false) {
            return null;
        }
        return $this->mapLigneVersImageMenu($ligne);
    }

    public function getAll(): array
    {
        $sql = 'SELECT * FROM image_menu';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $resultats = $stmt->fetchAll();

        $imagesMenu = [];
        foreach ($resultats as $resultat) {
            $imagesMenu[] = $this->mapLigneVersImageMenu($resultat);
        }
        return $imagesMenu;
    }

    public function save(ImageMenu $imageMenu): void
    {
        if ($imageMenu->getImageId() === null) {
            $sql = 'INSERT INTO image_menu (menu_id, url) VALUES (:menu_id, :url)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':menu_id', $imageMenu->getMenuId(), PDO::PARAM_INT);
            $stmt->bindValue(':url', $imageMenu->getUrlImage(), PDO::PARAM_STR);
            $stmt->execute();

            $imageMenu->setImageId((int)$this->pdo->lastInsertId());
        } else {
            $sql = 'UPDATE image_menu SET menu_id = :menu_id, url = :url WHERE image_id = :imageId';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':menu_id', $imageMenu->getMenuId(), PDO::PARAM_INT);
            $stmt->bindValue(':url', $imageMenu->getUrlImage(), PDO::PARAM_STR);
            $stmt->bindValue(':imageId', $imageMenu->getImageId(), PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    private function mapLigneVersImageMenu(array $ligne): ImageMenu
    {
        return new ImageMenu(
            imageId: $ligne['image_id'],
            menuId: $ligne['menu_id'],
            urlImage: $ligne['url']
        );
    }
}
