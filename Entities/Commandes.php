<?php
// Commandes.php
namespace Entities;

use JsonSerializable;

class Commandes implements JsonSerializable
{
    public function __construct(
        private ?int    $commandeId,
        private string  $numeroCommande,
        private int     $utilisateurId,
        private int     $menuId,
        private string  $datePrestation,
        private string  $heurePrestation,
        private string  $adresseLivraison,
        private int     $nombrePersonnes,
        private float   $prixMenu,
        private float   $prixLivraison,
        private float   $prixTotal,
        private string  $statut,
        private ?string $motifAnnulation,
        private ?string $modeContactAnnulation,
        private bool    $pretMateriel,
        private bool    $renduMateriel,
        private bool    $possedeAvis,
        private ?string $dateCommande = null,
    ) {
    }

    public function getCommandeId(): ?int
    {
        return $this->commandeId;
    }

    public function getNumeroCommande(): string
    {
        return $this->numeroCommande;
    }

    public function getUtilisateurId(): int
    {
        return $this->utilisateurId;
    }

    public function getMenuId(): int
    {
        return $this->menuId;
    }

    public function getDatePrestation(): string
    {
        return $this->datePrestation;
    }

    public function getHeurePrestation(): string
    {
        return $this->heurePrestation;
    }

    public function getAdresseLivraison(): string
    {
        return $this->adresseLivraison;
    }

    public function getNombrePersonnes(): int
    {
        return $this->nombrePersonnes;
    }

    public function getPrixMenu(): float
    {
        return $this->prixMenu;
    }

    public function getPrixLivraison(): float
    {
        return $this->prixLivraison;
    }

    public function getPrixTotal(): float
    {
        return $this->prixTotal;
    }

    public function getStatut(): string
    {
        return $this->statut;
    }

    public function getMotifAnnulation(): ?string
    {
        return $this->motifAnnulation;
    }

    public function getModeContactAnnulation(): ?string
    {
        return $this->modeContactAnnulation;
    }

    public function getPretMateriel(): bool
    {
        return $this->pretMateriel;
    }

    public function getRenduMateriel(): bool
    {
        return $this->renduMateriel;
    }

    public function getPossedeAvis(): bool
    {
        return $this->possedeAvis;
    }

    public function getDateCommande(): string
    {
        return $this->dateCommande;
    }

    public function setCommandeId(int $commandeId): void
    {
        $this->commandeId = $commandeId;
    }

    public function setPossedeAvis(bool $possedeAvis): void
    {
        $this->possedeAvis = $possedeAvis;
    }

    public function setStatut(string $statut): void
    {
        $this->statut = $statut;
    }

    public function setMotifAnnulation(string $motifAnnulation): void
    {
        $this->motifAnnulation = $motifAnnulation;
    }

    public function setModeContactAnnulation(string $modeContactAnnulation): void
    {
        $this->modeContactAnnulation = $modeContactAnnulation;
    }

    public function jsonSerialize(): array
    {
        return [
            'commande_id' => $this->commandeId,
            'numero_commande' => $this->numeroCommande,
            'utilisateur_id' => $this->utilisateurId,
            'menu_id' => $this->menuId,
            'date_prestation' => $this->datePrestation,
            'heure_prestation' => $this->heurePrestation,
            'adresse_livraison' => $this->adresseLivraison,
            'nombre_personnes' => $this->nombrePersonnes,
            'prix_menu' => $this->prixMenu,
            'prix_livraison' => $this->prixLivraison,
            'prix_total' => $this->prixTotal,
            'statut' => $this->statut,
            'motif_annulation' => $this->motifAnnulation,
            'mode_contact_annulation' => $this->modeContactAnnulation,
            'pret_materiel' => $this->pretMateriel,
            'rendu_materiel' => $this->renduMateriel,
            'possede_avis' => $this->possedeAvis,
            'date_commande' => $this->dateCommande,
        ];
    }
}
