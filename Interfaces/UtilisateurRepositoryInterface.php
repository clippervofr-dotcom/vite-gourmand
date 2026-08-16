<?php
// UtilisateurRepositoryInterface.php
namespace Interfaces;

use Entities\Utilisateur;

interface UtilisateurRepositoryInterface
{
    public function getById(int $id): ?Utilisateur;

    public function getAll(): array;

    public function estActif(): array;

    public function save(Utilisateur $utilisateur): void;

    public function delete(int $id): void;
}

?>