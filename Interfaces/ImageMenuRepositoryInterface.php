<?php
// ImageMenuRepositoryInterface.php
namespace Interfaces;

use Entities\ImageMenu;

interface ImageMenuRepositoryInterface
{
    public function getById(int $imageId): ?ImageMenu;

    public function getAll(): array;

    public function save(ImageMenu $imageMenu): void;

    public function delete(int $imageId): void;
}

?>