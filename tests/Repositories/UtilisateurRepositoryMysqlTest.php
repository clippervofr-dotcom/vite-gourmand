<?php
// UtilisateurRepositoryMysqlTest.php


use Entities\Utilisateur;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Repositories\UtilisateurRepositoryMysql;

#[CoversClass(UtilisateurRepositoryMysql::class)]
class UtilisateurRepositoryMysqlTest extends TestCase
{
    private static ?PDO $pdo = null;
    private UtilisateurRepositoryMysql $utilisateurRepository;

    public function setUp(): void
    {
        if (self::$pdo === null) {
            require_once __DIR__ . '/../../vendor/autoload.php';
            require_once __DIR__ . '/../../src/Config/bootstrap.php';
            self::$pdo = $pdo;
        }
        $this->utilisateurRepository = new UtilisateurRepositoryMysql(self::$pdo);
    }

    // a cause du require_once, on prend pdo et on le stock

    public function testGetById()
    {
        $utilisateur = $this->utilisateurRepository->getById(7);
        $this->assertInstanceOf(Utilisateur::class, $utilisateur);
    }

    public function testGetByEmail()
    {
        $utilisateur = $this->utilisateurRepository->getByEmail('djotest@gmail.com');
        $this->assertInstanceOf(Utilisateur::class, $utilisateur);
    }
}