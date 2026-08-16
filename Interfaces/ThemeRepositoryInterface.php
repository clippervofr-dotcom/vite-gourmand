<?php
// ThemeRepositoryInterface.php
namespace Interfaces;

use Entities\Theme;

interface ThemeRepositoryInterface
{
    public function getById(int $themeId): ?Theme;

    public function getAll(): array;

    public function save(Theme $theme): void;

    public function delete(int $themeId): void;
}

?>