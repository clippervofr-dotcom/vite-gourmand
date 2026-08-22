<?php
// Allergene.php
namespace Entities;

use JsonSerializable;

class Allergene implements JsonSerializable
{
    public function __construct(
        private ?int   $allergeneId,
        private string $libelle
    ) {}

    public function getAllergeneId(): ?int
    {
        return $this->allergeneId;
    }

    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public function setAllergeneId(int $allergeneId): void
    {
        $this->allergeneId = $allergeneId;
    }

    public function jsonSerialize(): array
    {
        return [
            'allergene_id' => $this->allergeneId,
            'libelle' => $this->libelle
        ];
    }
}
