<?php
// Utilisateur.php
namespace Entities;

use JsonSerializable;

class Utilisateur implements JsonSerializable
{
    public function __construct(
        private ?int $utilisateurId,
        private string $nom,
        private string $prenom,
        private string $email,
        private string $telephone,
        private string $adresse,
        private string $ville,
        private string $codePostal,
        private bool $actif,
        private int $roleId
    ) {
    }

    public function getId(): ?int
    {
        return $this->utilisateurId;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function getAdresse(): string
    {
        return $this->adresse;
    }

    public function getVille(): string
    {
        return $this->ville;
    }

    public function getCodePostal(): string
    {
        return $this->codePostal;
    }

    public function getActif(): bool
    {
        return $this->actif;
    }

    public function getRoleId(): int
    {
        return $this->roleId;
    }

    public function setId(int $utilisateurId): void
    {
        $this->utilisateurId = $utilisateurId;
    }

    public function jsonSerialize(): array
    {
        return [
            'utilisateur_id' => $this->utilisateurId,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'adresse' => $this->adresse,
            'ville' => $this->ville,
            'code_postal' => $this->codePostal,
            'role_id' => $this->roleId,
        ];
    }
}
