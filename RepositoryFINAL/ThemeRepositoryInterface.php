<?php
// ThemeRepositoryInterface.php
interface ThemeRepositoryInterface {
    public function getById(int $themeId): ?Theme;

    public function getAll(): array;

    public function save(Theme $theme): void;

    public function delete(int $themeId): void;
}
?>