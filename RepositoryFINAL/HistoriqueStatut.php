<?php
// HistoriqueStatut.php
class HistoriqueStatut {
    public function __construct(
        private ?int $historiqueStatutId,
        private int $commandeId,
        private string $statut,
        private string $dateChangementStatut
    ) {}

    public function getHistoriqueStatutId(): ?int { return $this->historiqueStatutId; }
    public function getCommandeId(): int { return $this->commandeId; }
    public function getStatut(): string { return $this->statut; }
    public function getDateChangementStatut(): string { return $this->dateChangementStatut; }
    public function setHistoriqueStatutId(int $historiqueStatutId): void { $this->historiqueStatutId = $historiqueStatutId; }
}
?>