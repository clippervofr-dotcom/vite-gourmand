<?php
// HorairesRepositoryInterface.php

interface HorairesRepositoryInterface {
    public function getById(int $id): ?Horaires;

    public function getAll(): array;

    public function save(Horaires $horaire): void;

    public function delete(int $id): void;
}
?>