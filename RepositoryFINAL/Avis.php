<?php
// Avis.php
class Avis {
    public function __construct (
        private ?int $avisId,
        private int $utilisateurId,
        private int $commandeId,
        private int $note,
        private string $descriptionAvis,
        private string $statut
    ) {}

    public function getAvisId(): ?int {
        return $this->avisId;
    }

    public function getUtilisateurId(): int {
        return $this->utilisateurId;
    }

    public function getCommandeId(): int {
        return $this->commandeId;
    }

    public function getNote(): int {
        return $this->note;
    }

    public function getDescriptionAvis(): string {
        return $this->descriptionAvis;
    }

    public function getStatut(): string {
        return $this->statut;
    }

    public function setAvisId(int $avisId): void {
        $this->avisId = $avisId;
    }
}
?>