<?php
// HorairesRepositoryInterface.php

namespace Interfaces;

use Entities\Horaires;

interface HorairesRepositoryInterface
{
    public function getById(int $horaireId): ?Horaires;
    public function getByOrderedId(): array;
    public function getAll(): array;
    public function save(Horaires $horaire): void;
    public function delete(int $horaireId): void;
}
