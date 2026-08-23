<?php
// CommandesRepositoryMysqlTest.php

namespace Repositories;

use Entities\Commandes;
use Interfaces\HistoriqueStatutRepositoryInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(CommandesRepositoryMysql::class)]
class CommandesRepositoryMysqlTest extends TestCase
{
    private static ?PDO $pdo = null;
    private CommandesRepositoryMysql $commandesRepository;
    private HistoriqueStatutRepositoryInterface $historiqueRepository;

    public function setUp(): void
    {
        if (self::$pdo === null) {
            require_once __DIR__ . '/../../vendor/autoload.php';
            require_once __DIR__ . '/../../src/Config/bootstrap.php';
            self::$pdo = $pdo;
        }
        $this->historiqueRepository = new HistoriqueStatutRepositoryMysql(self::$pdo);
        $this->commandesRepository = new CommandesRepositoryMysql(self::$pdo, $this->historiqueRepository);

    }

    public function testGetById()
    {
        $commandeId = 1;

        $commande = $this->commandesRepository->getById($commandeId);
        $this->assertInstanceOf(Commandes::class, $commande);

        $commandeArray = $commande->jsonSerialize();
        $this->assertArrayHasKey('commande_id', $commandeArray);
        $this->assertArrayHasKey('numero_commande', $commandeArray);
        $this->assertArrayHasKey('utilisateur_id', $commandeArray);
        $this->assertArrayHasKey('menu_id', $commandeArray);
        $this->assertArrayHasKey('date_prestation', $commandeArray);
        $this->assertArrayHasKey('heure_prestation', $commandeArray);
        $this->assertArrayHasKey('adresse_livraison', $commandeArray);
        $this->assertArrayHasKey('nombre_personnes', $commandeArray);
        $this->assertArrayHasKey('prix_menu', $commandeArray);
        $this->assertArrayHasKey('prix_livraison', $commandeArray);
        $this->assertArrayHasKey('prix_total', $commandeArray);
        $this->assertArrayHasKey('statut', $commandeArray);
        $this->assertArrayHasKey('motif_annulation', $commandeArray);
        $this->assertArrayHasKey('mode_contact_annulation', $commandeArray);
        $this->assertArrayHasKey('pret_materiel', $commandeArray);
        $this->assertArrayHasKey('rendu_materiel', $commandeArray);
        $this->assertArrayHasKey('possede_avis', $commandeArray);
        $this->assertArrayHasKey('date_commande', $commandeArray);

        $this->assertEquals('COMMANDE-343', $commande->getNumeroCommande());
    }

    public function testFindByStatut()
    {
        $statut = 'en attente';
        $commandes = $this->commandesRepository->findByStatut($statut);
        $this->assertEquals($statut, $commandes[0]->getStatut());
    }

}