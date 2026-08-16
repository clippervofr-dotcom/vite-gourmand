<?php
// ImageMenu.php
namespace Entities;
class ImageMenu
{
    public function __construct(
        private ?int   $imageId,
        private ?int   $menuId,
        private string $urlImage
    )
    {
    }

    public function getImageId(): ?int
    {
        return $this->imageId;
    }

    public function getMenuId(): ?int
    {
        return $this->menuId;
    }

    public function getUrlImage(): string
    {
        return $this->urlImage;
    }

    public function setImageId(int $imageId): void
    {
        $this->imageId = $imageId;
    }

    public function setMenuId(int $menuId): void
    {
        $this->menuId = $menuId;
    }
}

?>