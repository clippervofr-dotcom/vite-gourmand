<?php
// HistoriqueStatutRepositoryInterface.php
namespace Interfaces;

use Entities\HistoriqueStatut;

interface HistoriqueStatutRepositoryInterface
{
    public function getAll(): array;

    public function getById(int $historiqueStatutId): ?HistoriqueStatut;

    public function save(HistoriqueStatut $historiqueStatut): void;

    public function delete(int $historiqueStatutId): void;

    public function findByCommandeId(int $commandeId): array;

    public function findByStatut(string $statut): array;

    public function findByDateChangementStatut(string $dateChangementStatut): array;
}
