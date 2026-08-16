<?php
// RegimeRepositoryInterface.php
namespace Interfaces;

use Entities\Regime;

interface RegimeRepositoryInterface
{
    public function getById(int $regimeId): ?Regime;

    public function getAll(): array;

    public function save(Regime $regime): void;

    public function delete(int $regimeId): void;
}

?>