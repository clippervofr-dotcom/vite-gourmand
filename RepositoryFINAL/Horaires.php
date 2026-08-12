<?php
// Horaires.php
class Horaires implements JsonSerializable {
    
    public function __construct(
        private ?int $id,
        private string $jour,
        private string $debut,
        private string $fin
    ) {}

    public function getId(): ?int {
        return $this->id;
    }

    public function getJour(): string {
        return $this->jour;
    }

    public function getDebut(): string {
        return $this->debut;
    }

    public function getFin(): string {
        return $this->fin;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function jsonSerialize(): array {
        return [
            'jour' => $this->jour,
            'debut' => $this->debut,
            'fin' => $this->fin,
        ];
    }
}
?>