<?php
// ImageMenuRepositoryInterface.php
namespace Interfaces;

use Entities\ImageMenu;

interface ImageMenuRepositoryInterface
{
    public function getByImageId(int $imageId): ?ImageMenu;
    public function getByMenuId(int $menuId): ?ImageMenu;
    public function getAll(): array;
    public function save(ImageMenu $imageMenu): void;
}
