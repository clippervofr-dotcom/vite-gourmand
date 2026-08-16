<?php
// AllergeneRepositoryInterface.php
namespace Interfaces;

use Entities\Allergene;

interface AllergeneRepositoryInterface
{
    public function getById(int $allergeneId): ?Allergene;

    public function getAll(): array;

    public function save(Allergene $allergene): void;

    public function delete(int $allergeneId): void;
}

?>