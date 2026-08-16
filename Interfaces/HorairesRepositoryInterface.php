<?php
// HorairesRepositoryInterface.php

namespace Interfaces;

use Entities\Horaires;

interface HorairesRepositoryInterface
{
    public function getById(int $id): ?Horaires;

    public function getAll(): array;

    public function save(Horaires $horaire): void;

    public function delete(int $id): void;
}
