<?php
// MenuRepositoryInterface.php

namespace Interfaces;

use Entities\Menu;

interface MenuRepositoryInterface
{
    public function getById(int $menuId): ?Menu;

    public function getAll(): array;

    public function save(Menu $menu): void;

    public function delete(int $menuId): void;

    public function getThemeByMenu(int $menuId): array;

    public function getRegimeByMenu(int $menuId): array;
}
