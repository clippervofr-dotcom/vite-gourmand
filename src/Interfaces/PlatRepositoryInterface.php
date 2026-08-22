<?php
// PlatRepositoryInterface.php
namespace Interfaces;

use Entities\Plat;

interface PlatRepositoryInterface
{
    public function getPlatById(int $platId): ?Plat;
    public function getAll(): array;
    public function getByType(string $typePlat): array;
    public function getAllergeneByPlatId(int $platId): ?array;
    public function getPlatByMenuId(int $menuId): array;
    public function getPlatByAllergeneId(int $allergeneId): array;
    public function save(Plat $plat): void;
    public function delete(int $platId): void;
}