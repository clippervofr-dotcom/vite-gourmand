<?php
// Allergene.php
class Allergene {
    public function __construct (
        private ?int $allergeneId,
        private string $libelle
    ) {}

    public function getAllergeneId(): ?int {
        return $this->allergeneId;
    }

    public function getLibelle(): string {
        return $this->libelle;
    }

    public function setAllergeneId(int $allergeneId): void {
        $this->allergeneId = $allergeneId;
    }
}
?>