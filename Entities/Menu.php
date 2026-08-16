<?php
// Menus.php
namespace Entities;

use JsonSerializable;

class Menu implements JsonSerializable
{
    public function __construct(
        private ?int   $menuId,
        private string $titre,
        private string $descriptionMenu,
        private int    $nombrePersonneMinimum,
        private float  $prixParPersonne,
        private string $conditions,
        private int    $quantiteRestante,
        private bool   $actif
    ) {}

    public function getId(): ?int
    {
        return $this->menuId;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function getDescriptionMenu(): string
    {
        return $this->descriptionMenu;
    }

    public function getNombrePersonneMinimum(): int
    {
        return $this->nombrePersonneMinimum;
    }

    public function getPrixParPersonne(): float
    {
        return $this->prixParPersonne;
    }

    public function getConditions(): string
    {
        return $this->conditions;
    }

    public function getQuantiteRestante(): int
    {
        return $this->quantiteRestante;
    }

    public function getActif(): bool
    {
        return $this->actif;
    }

    public function setId(int $id): void
    {
        $this->menuId = $id;
    }

    public function jsonSerialize(): array
    {
        return [
            'menu_id' => $this->menuId,
            'titre' => $this->titre,
            'description_menu' => $this->descriptionMenu,
            'nombre_personne_minimum' => $this->nombrePersonneMinimum,
            'prix_par_personne' => $this->prixParPersonne,
            'conditions' => $this->conditions,
            'quantite_restante' => $this->quantiteRestante,
            'actif' => $this->actif
        ];
    }
}

?>