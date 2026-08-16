<?php
// Avis.php
namespace Entities;
class Avis
{
    public function __construct(
        private int    $utilisateurId,
        private int    $commandeId,
        private int    $note,
        private string $commentaire,
        private string $dateAvis,
    ) {
    }

    public function getUtilisateurId(): int
    {
        return $this->utilisateurId;
    }

    public function getCommandeId(): int
    {
        return $this->commandeId;
    }

    public function getNote(): int
    {
        return $this->note;
    }

    public function getDateAvis(): string
    {
        return $this->dateAvis;
    }

    public function getCommentaire(): string
    {
        return $this->commentaire;
    }
}