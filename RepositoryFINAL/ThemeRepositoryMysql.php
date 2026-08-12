<?php 
// ThemeRepositoryMysql.php
class ThemeRepositoryMysql implements ThemeRepositoryInterface {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getById(int $themeId): ?Theme {
        $sql = 'SELECT * FROM theme WHERE theme_id = :themeId';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':themeId', $themeId, PDO::PARAM_INT);
        $stmt->execute();

        $ligne = $stmt->fetch();

        if ($ligne === false) {
            return null;
        }
        return $this->mapLigneVersTheme($ligne);
    }

    public function getAll(): array {
        $sql = 'SELECT * FROM theme';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $resultats = $stmt->fetchAll();

        $themes = [];
        foreach ($resultats as $resultat) {
            $themes[] = $this->mapLigneVersTheme($resultat);
        }
        return $themes;
    }

    public function save(Theme $theme): void {
        if ($theme->getThemeId() === null) {
            $sql = 'INSERT INTO theme (libelle) VALUES (:libelle)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':libelle', $theme->getLibelle(), PDO::PARAM_STR);
            $stmt->execute();

            $theme->setThemeId((int) $this->pdo->lastInsertId());
        } else {
            $sql = 'UPDATE theme SET libelle = :libelle WHERE theme_id = :themeId';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':libelle', $theme->getLibelle(), PDO::PARAM_STR);
            $stmt->bindValue(':themeId', $theme->getThemeId(), PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public function delete(int $themeId): void {
        $sql = 'DELETE FROM theme WHERE theme_id = :themeId';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':themeId', $themeId, PDO::PARAM_INT);
        $stmt->execute();
    }

    private function mapLigneVersTheme(array $ligne): Theme {
        return new Theme(
            themeId: $ligne['theme_id'],
            libelle: $ligne['libelle']
        );
    }
}
?>