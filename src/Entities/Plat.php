<?php
// Plat.php

namespace Entities;

use JsonSerializable;

class Plat implements JsonSerializable {


    public function __construct(
        private ?int $platId,
        private string $nom,
        private string $typePlat,
        private string $descriptionPlat,
        private ?string $photo,
    ) {}

    public function getPlatId(): ?int {
        return $this->platId;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getTypePlat(): string {
        return $this->typePlat;
    }

    public function getDescriptionPlat(): string {
        return $this->descriptionPlat;
    }

    public function getPhoto(): ?string {
        return $this->photo;
    }

    public function setPlatId(int $platId): void {
        $this->platId = $platId;
    }

    public function jsonSerialize(): array
    {
        return [
            'plat_id' => $this->platId,
            'nom' => $this->nom,
            'type_plat' => $this->typePlat,
            'description_plat' => $this->descriptionPlat,
            'photo' => $this->photo
        ];
    }
}
