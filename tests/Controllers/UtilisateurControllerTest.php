<?php

use Controllers\UtilisateurController;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(UtilisateurController::class)]
class UtilisateurControllerTest extends TestCase
{

    public function setUp(): void
    {
        require_once __DIR__ . '/../../vendor/autoload.php';
        require_once __DIR__ . '/../../src/Config/bootstrap.php';
        $utilisateurRepository = new Repositories\UtilisateurRepositoryMysql($pdo);
        $this->utilisateurController = new UtilisateurController($utilisateurRepository);
    }

    public function testVerifPassword()
    {
        $utilisateurId = 4;
        $password = 'testTEST1@';

        $verification = $this->utilisateurController->verifPassword($utilisateurId, $password);
        $this->assertTrue($verification);
    }
}