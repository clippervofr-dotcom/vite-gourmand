<?php
// CommandesRepositoryMysql.php
namespace Repositories;

use Entities\Commandes;
use Entities\HistoriqueStatut;
use Interfaces\CommandesRepositoryInterface;
use Interfaces\HistoriqueStatutRepositoryInterface;
use PDO;

class CommandesRepositoryMysql implements CommandesRepositoryInterface
{

    private PDO $pdo;
    private HistoriqueStatutRepositoryInterface $historiqueRepository;

    public function __construct(PDO $pdo, HistoriqueStatutRepositoryInterface $historiqueRepository)
    {
        $this->pdo = $pdo;
        $this->historiqueRepository = $historiqueRepository;
    }

    public function getById(int $commandeId): ?Commandes
    {
        $sql = 'SELECT * FROM commande WHERE commande_id = :commande_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':commande_id', $commandeId, PDO::PARAM_INT);
        $stmt->execute();
        $ligne = $stmt->fetch();

        if ($ligne === false) {
            return null;
        }
        return $this->mapLigneVersCommandes($ligne);
    }

    public function getAll(): array
    {
        $sql = 'SELECT * FROM commande';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $resultats = $stmt->fetchAll();

        $commandes = [];
        foreach ($resultats as $resultat) {
            $commandes[] = $this->mapLigneVersCommandes($resultat);
        }
        return $commandes;
    }

    public function findByUtilisateurId(int $utilisateurId): array
    {
        $sql = 'SELECT * FROM commande WHERE utilisateur_id = :utilisateur_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':utilisateur_id', $utilisateurId, PDO::PARAM_INT);
        $stmt->execute();

        $resultats = $stmt->fetchAll();

        $commandes = [];
        foreach ($resultats as $resultat) {
            $commandes[] = $this->mapLigneVersCommandes($resultat);
        }
        return $commandes;
    }

    public function findByMenuId(int $menuId): array
    {
        $sql = 'SELECT * FROM commande WHERE menu_id = :menu_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':menu_id', $menuId, PDO::PARAM_INT);
        $stmt->execute();

        $resultats = $stmt->fetchAll();

        $commandes = [];
        foreach ($resultats as $resultat) {
            $commandes[] = $this->mapLigneVersCommandes($resultat);
        }
        return $commandes;
    }

    public function findByDateCommande(string $dateCommande): array
    {
        $sql = 'SELECT * FROM commande WHERE date_commande = :date_commande';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':date_commande', $dateCommande, PDO::PARAM_STR);
        $stmt->execute();

        $resultats = $stmt->fetchAll();

        $commandes = [];
        foreach ($resultats as $resultat) {
            $commandes[] = $this->mapLigneVersCommandes($resultat);
        }
        return $commandes;
    }

    public function findByDatePrestation(string $datePrestation): array
    {
        $sql = 'SELECT * FROM commande WHERE date_prestation = :date_prestation';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':date_prestation', $datePrestation, PDO::PARAM_STR);
        $stmt->execute();

        $resultats = $stmt->fetchAll();

        $commandes = [];
        foreach ($resultats as $resultat) {
            $commandes[] = $this->mapLigneVersCommandes($resultat);
        }
        return $commandes;
    }

    public function findByStatut(string $statut): array
    {
        $sql = 'SELECT * FROM commande WHERE statut = :statut';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':statut', $statut, PDO::PARAM_STR);
        $stmt->execute();

        $resultats = $stmt->fetchAll();

        $commandes = [];
        foreach ($resultats as $resultat) {
            $commandes[] = $this->mapLigneVersCommandes($resultat);
        }
        return $commandes;
    }

    public function findByPossedeAvis(bool $possedeAvis): array
    {
        $sql = 'SELECT * FROM commande WHERE possede_avis = :possede_avis';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':possede_avis', $possedeAvis, PDO::PARAM_BOOL);
        $stmt->execute();

        $resultats = $stmt->fetchAll();

        $commandes = [];
        foreach ($resultats as $resultat) {
            $commandes[] = $this->mapLigneVersCommandes($resultat);
        }
        return $commandes;
    }

    public function findByNumeroCommande(string $numeroCommande): ?Commandes
    {
        $sql = 'SELECT * FROM commande WHERE numero_commande = :numero_commande';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':numero_commande', $numeroCommande, PDO::PARAM_STR);
        $stmt->execute();

        $ligne = $stmt->fetch();

        if ($ligne === false) {
            return null;
        }
        return $this->mapLigneVersCommandes($ligne);
    }

    public function save(Commandes $commande): void
    {
        if ($commande->getCommandeId() === null) {
            $sql = 'INSERT INTO commande (numero_commande, utilisateur_id, menu_id, date_prestation, heure_prestation, adresse_livraison, nombre_personnes, prix_menu, prix_livraison, prix_total, statut, motif_annulation, mode_contact_annulation, pret_materiel, rendu_materiel, possede_avis) VALUES (:numero_commande, :utilisateur_id, :menu_id, :date_prestation, :heure_prestation, :adresse_livraison, :nombre_personnes, :prix_menu, :prix_livraison, :prix_total, :statut, :motif_annulation, :mode_contact_annulation, :pret_materiel, :rendu_materiel, :possede_avis)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':numero_commande', $commande->getNumeroCommande(), PDO::PARAM_STR);
            $stmt->bindValue(':utilisateur_id', $commande->getUtilisateurId(), PDO::PARAM_INT);
            $stmt->bindValue(':menu_id', $commande->getMenuId(), PDO::PARAM_INT);
            $stmt->bindValue(':date_prestation', $commande->getDatePrestation(), PDO::PARAM_STR);
            $stmt->bindValue(':heure_prestation', $commande->getHeurePrestation(), PDO::PARAM_STR);
            $stmt->bindValue(':adresse_livraison', $commande->getAdresseLivraison(), PDO::PARAM_STR);
            $stmt->bindValue(':nombre_personnes', $commande->getNombrePersonnes(), PDO::PARAM_INT);
            $stmt->bindValue(':prix_menu', $commande->getPrixMenu(), PDO::PARAM_STR);
            $stmt->bindValue(':prix_livraison', $commande->getPrixLivraison(), PDO::PARAM_STR);
            $stmt->bindValue(':prix_total', $commande->getPrixTotal(), PDO::PARAM_STR);
            $stmt->bindValue(':statut', $commande->getStatut(), PDO::PARAM_STR);
            $stmt->bindValue(':motif_annulation', $commande->getMotifAnnulation(), $commande->getMotifAnnulation() === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindValue(':mode_contact_annulation', $commande->getModeContactAnnulation(), $commande->getModeContactAnnulation() === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindValue(':pret_materiel', $commande->getPretMateriel(), PDO::PARAM_BOOL);
            $stmt->bindValue(':rendu_materiel', $commande->getRenduMateriel(), PDO::PARAM_BOOL);
            $stmt->bindValue(':possede_avis', $commande->getPossedeAvis(), PDO::PARAM_BOOL);
            $stmt->execute();

            $commande->setCommandeId((int)$this->pdo->lastInsertId());

            $this->historiqueRepository->save(
                new HistoriqueStatut(null, $commande->getCommandeId(), $commande->getStatut(), date('Y-m-d H:i:s'))
            );

        } else {
            $stmtVerif = $this->pdo->prepare('SELECT statut FROM commande WHERE commande_id = :commande_id');
            $stmtVerif->bindValue(':commande_id', $commande->getCommandeId(), PDO::PARAM_INT);
            $stmtVerif->execute();
            $ancienStatut = $stmtVerif->fetchColumn();

            $sql = 'UPDATE commande SET numero_commande = :numero_commande, utilisateur_id = :utilisateur_id, menu_id = :menu_id, date_prestation = :date_prestation, heure_prestation = :heure_prestation, adresse_livraison = :adresse_livraison, nombre_personnes = :nombre_personnes, prix_menu = :prix_menu, prix_livraison = :prix_livraison, prix_total = :prix_total, statut = :statut, motif_annulation = :motif_annulation, mode_contact_annulation = :mode_contact_annulation, pret_materiel = :pret_materiel, rendu_materiel = :rendu_materiel, possede_avis = :possede_avis WHERE commande_id = :commande_id';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':numero_commande', $commande->getNumeroCommande(), PDO::PARAM_STR);
            $stmt->bindValue(':utilisateur_id', $commande->getUtilisateurId(), PDO::PARAM_INT);
            $stmt->bindValue(':menu_id', $commande->getMenuId(), PDO::PARAM_INT);
            $stmt->bindValue(':date_prestation', $commande->getDatePrestation(), PDO::PARAM_STR);
            $stmt->bindValue(':heure_prestation', $commande->getHeurePrestation(), PDO::PARAM_STR);
            $stmt->bindValue(':adresse_livraison', $commande->getAdresseLivraison(), PDO::PARAM_STR);
            $stmt->bindValue(':nombre_personnes', $commande->getNombrePersonnes(), PDO::PARAM_INT);
            $stmt->bindValue(':prix_menu', $commande->getPrixMenu(), PDO::PARAM_STR);
            $stmt->bindValue(':prix_livraison', $commande->getPrixLivraison(), PDO::PARAM_STR);
            $stmt->bindValue(':prix_total', $commande->getPrixTotal(), PDO::PARAM_STR);
            $stmt->bindValue(':statut', $commande->getStatut(), PDO::PARAM_STR);
            $stmt->bindValue(':motif_annulation', $commande->getMotifAnnulation(), $commande->getMotifAnnulation() === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindValue(':mode_contact_annulation', $commande->getModeContactAnnulation(), $commande->getModeContactAnnulation() === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindValue(':pret_materiel', $commande->getPretMateriel(), PDO::PARAM_BOOL);
            $stmt->bindValue(':rendu_materiel', $commande->getRenduMateriel(), PDO::PARAM_BOOL);
            $stmt->bindValue(':possede_avis', $commande->getPossedeAvis(), PDO::PARAM_BOOL);
            $stmt->bindValue(':commande_id', $commande->getCommandeId(), PDO::PARAM_INT);
            $stmt->execute();

            /* Ajout historique_statut seulement si changement statut */
            if ($ancienStatut !== $commande->getStatut()) {
                $this->historiqueRepository->save(
                    new HistoriqueStatut(null, $commande->getCommandeId(), $commande->getStatut(), date('Y-m-d H:i:s'))
                );
            }
        }
    }

    public function delete(int $commandeId): void
    {
        $sql = 'DELETE FROM commande WHERE commande_id = :commande_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':commande_id', $commandeId, PDO::PARAM_INT);
        $stmt->execute();
    }

    private function mapLigneVersCommandes(array $ligne): Commandes
    {
        return new Commandes(
            commandeId: $ligne['commande_id'],
            numeroCommande: $ligne['numero_commande'],
            utilisateurId: $ligne['utilisateur_id'],
            menuId: $ligne['menu_id'],
            datePrestation: $ligne['date_prestation'],
            heurePrestation: $ligne['heure_prestation'] ?? '',
            adresseLivraison: $ligne['adresse_livraison'] ?? '',
            nombrePersonnes: (int)$ligne['nombre_personnes'],
            prixMenu: (float)$ligne['prix_menu'],
            prixLivraison: (float)$ligne['prix_livraison'],
            prixTotal: (float)$ligne['prix_total'],
            statut: $ligne['statut'],
            motifAnnulation: $ligne['motif_annulation'],
            modeContactAnnulation: $ligne['mode_contact_annulation'],
            pretMateriel: (bool)$ligne['pret_materiel'],
            renduMateriel: (bool)$ligne['rendu_materiel'],
            possedeAvis: (bool)$ligne['possede_avis'],
            dateCommande: $ligne['date_commande']
        );
    }
}

?>