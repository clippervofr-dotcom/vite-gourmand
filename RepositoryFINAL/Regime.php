<?php
// Regime.php
class Regime {
    public function __construct (
        private ?int $regimeId,
        private string $libelle
    ) {}

    public function getRegimeId(): ?int {
        return $this->regimeId;
    }

    public function getLibelle(): string {
        return $this->libelle;
    }

    public function setRegimeId(int $regimeId): void {
        $this->regimeId = $regimeId;
    }
}
?>