<?php
// Horaires.php
namespace Entities;

use JsonSerializable;

class Horaires implements JsonSerializable
{
    public function __construct(
        private ?int   $horaireId,
        private string $jour,
        private ?string $heureOuverture,
        private ?string $heureFermeture
    ) {}
    public function getHoraireId(): ?int
    {
        return $this->horaireId;
    }

    public function getJour(): string
    {
        return $this->jour;
    }

    public function getHeureOuverture(): string
    {
        return $this->heureOuverture;
    }

    public function getHeureFermeture(): string
    {
        return $this->heureFermeture;
    }

    public function setHoraireId(int $horaireId): void
    {
        $this->horaireId = $horaireId;
    }

    public function jsonSerialize(): array
    {
        return [
            'jour' => $this->jour,
            'heure_ouverture' => $this->heureOuverture,
            'heure_fermeture' => $this->heureFermeture,
        ];
    }
}

