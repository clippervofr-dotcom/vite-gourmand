<?php
// Tests pour TarificationService


namespace Services;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(TarificationService::class)]
class TarificationServiceTest extends TestCase
{


    public function testCalculerDistanceKm()
    {
        $adresse = "11 Rue Charles Gounod 33000 Bordeaux France";
        $resultat = TarificationService::calculerDistanceKm($adresse);
        $this->assertIsNumeric($resultat);
    }

    public function testCalculerPrixLivraisonAvecDistance()
    {
        $distanceKm = 10;
        $prixTotal = 50;

        $resultat = TarificationService::calculerPrixLivraison($distanceKm, $prixTotal);
        $this->assertArrayHasKey('prixMateriel', $resultat);
        $this->assertArrayHasKey('prixTotalDistance', $resultat);
        $this->assertArrayHasKey('totalAvecMateriel', $resultat);
        $this->assertArrayHasKey('totalSansMateriel', $resultat);
    }

    public function testCalculerPrixLivraisonAvecDistanceGratuite()
    {
        $distanceKm = 3; // Moins que la distance gratuite
        $prixTotal = 50;

        $resultat = TarificationService::calculerPrixLivraison($distanceKm, $prixTotal);
        $this->assertEquals(0, $resultat['prixTotalDistance']);
    }

    public function testCalculerPrixLivraisonSeuil()
    {
        $distanceKm = 5; // Seuil pour la distance gratuite
        $prixTotal = 50;

        $resultat = TarificationService::calculerPrixLivraison($distanceKm, $prixTotal);
        $this->assertEquals(0, $resultat['prixTotalDistance']);
    }

    public function testAppliquerReductionOui()
    {
        $quantite = 20;
        $prixParPersonne = 30;
        $nombrePersonnesMinimum = 6; // Plus que le nombre de personnes pour la réduction

        $resultat = TarificationService::appliquerReduction($quantite, $nombrePersonnesMinimum, $prixParPersonne);
        $this->assertEquals(540, $resultat); // 10% de réduction
    }

    public function testAppliquerReductionNon()
    {
        $quantite = 5;
        $prixParPersonne = 30;
        $nombrePersonnesMinimum = 6; // Moins que le nombre de personnes pour la réduction

        $resultat = TarificationService::appliquerReduction($quantite, $nombrePersonnesMinimum, $prixParPersonne);
        $this->assertEquals(150, $resultat); // Pas de réduction
    }

    public function testAppliquerReductionSeuil()
    {
        $quantite = 11; // Seuil pour la réduction
        $prixParPersonne = 30;
        $nombrePersonnesMinimum = 6; // Seuil pour la réduction

        $resultat = TarificationService::appliquerReduction($quantite, $nombrePersonnesMinimum, $prixParPersonne);
        $this->assertEquals(297, $resultat); // 10% de réduction
    }
}
