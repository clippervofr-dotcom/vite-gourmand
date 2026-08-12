<?php
// RegimeRepositoryInterface.php
interface RegimeRepositoryInterface {
    public function getById(int $regimeId): ?Regime;

    public function getAll(): array;

    public function save(Regime $regime): void;

    public function delete(int $regimeId): void;
}
?>