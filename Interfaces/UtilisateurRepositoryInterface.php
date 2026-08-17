<?php
// UtilisateurRepositoryInterface.php
namespace Interfaces;

use Entities\Utilisateur;

interface UtilisateurRepositoryInterface
{
    public function getById(int $utilisateurId): ?Utilisateur;
    public function getByEmail(string $email): ?Utilisateur;
    public function getByRoleId(int $roleId): ?Utilisateur;
    public function getAll(): array;
    public function estActif(): array;
    public function save(Utilisateur $utilisateur): void;
    public function delete(int $utilisateurId): void;
}
