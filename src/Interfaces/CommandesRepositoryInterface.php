<?php
// CommandesRepositoryInterface.php
namespace Interfaces;

use Entities\Commandes;

interface CommandesRepositoryInterface
{
    public function getById(int $commandeId): ?Commandes;
    public function getAll(): array;
    public function findByUtilisateurId(int $utilisateurId): array;
    public function findByMenuId(int $menuId): array;
    public function findByDateCommande(string $dateCommande): array;
    public function findByDatePrestation(string $datePrestation): array;
    public function findByStatut(string $statut): array;
    public function findByPossedeAvis(bool $possedeAvis): array;
    public function findByNumeroCommande(string $numeroCommande): ?Commandes;
    public function changerDeStatut(int $commandeId, string $nouveauStatut): void;
    public function save(Commandes $commande): void;
    public function delete(int $commandeId): void;
}

?>