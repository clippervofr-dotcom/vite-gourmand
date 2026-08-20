<?php
// HistoriqueStatutRepositoryInterface.php
namespace Interfaces;

use Entities\HistoriqueStatut;

interface HistoriqueStatutRepositoryInterface
{

    public function save(HistoriqueStatut $historiqueStatut): void;
}
