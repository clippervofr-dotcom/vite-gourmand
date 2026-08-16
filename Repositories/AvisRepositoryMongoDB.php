<?php

namespace Repositories;

use Entities\Avis;
use Interfaces\AvisRepositoryInterface;
use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;
use MongoDB\Driver\BulkWrite;

class AvisRepositoryMongoDB implements AvisRepositoryInterface
{

    private Manager $manager;

    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    public function getByNote(int $note): array
    {
        $filter = ['note' => $note];
        $query = new Query($filter);
        $cursor = $this->manager->executeQuery('vite_et_gourmand.avis', $query);

        $avisList = [];
        foreach ($cursor as $result) {
            $avisList[] = $this->mapLigneVersAvis($result);
        }
        return $avisList;
    }

    public function getByUtilisateurId(int $utilisateurId): array
    {
        $filter = ['utilisateur_id' => $utilisateurId];
        $query = new Query($filter);
        $cursor = $this->manager->executeQuery('vite_et_gourmand.avis', $query);

        $avisList = [];
        foreach ($cursor as $result) {
            $avisList[] = $this->mapLigneVersAvis($result);
        }
        return $avisList;
    }

    public function getByDateAvis(string $dateAvis): array
    {

        $filter = ['date_avis' => $dateAvis];
        $query = new Query($filter);
        $cursor = $this->manager->executeQuery('vite_et_gourmand.avis', $query);

        $avisList = [];
        foreach ($cursor as $result) {
            $avisList[] = $this->mapLigneVersAvis($result);
        }
        return $avisList;
    }

    public function getByCommandeId(int $commandeId): array
    {
        $filter = ['commande_id' => $commandeId];
        $query = new Query($filter);
        $cursor = $this->manager->executeQuery('vite_et_gourmand.avis', $query);

        $avisList = [];
        foreach ($cursor as $result) {
            $avisList[] = $this->mapLigneVersAvis($result);
        }
        return $avisList;
    }

    public function getAll(): array
    {
        $query = new Query([], ['sort' => ['note' => -1, 'date-avis' => -1]]);
        $cursor = $this->manager->executeQuery('vite_et_gourmand.avis', $query);

        $avisList = [];
        foreach ($cursor as $result) {
            $avisList[] = $this->mapLigneVersAvis($result);
        }
        return $avisList;
    }

    public function save(Avis $avis): void
    {
        $bulk = new BulkWrite;
        $document = [
            'utilisateur_id' => $avis->getUtilisateurId(),
            'commande_id' => $avis->getCommandeId(),
            'note' => $avis->getNote(),
            'commentaire' => $avis->getCommentaire(),
            'date_avis' => $avis->getDateAvis()
        ];
        $bulk->insert($document);
        $this->manager->executeBulkWrite('vite_et_gourmand.avis', $bulk);
    }

    public function delete(int $commandeId): void
    {
        $bulk = new BulkWrite;
        $filter = ['commande_id' => $commandeId];
        $bulk->delete($filter);
        $this->manager->executeBulkWrite('vite_et_gourmand.avis', $bulk);
    }

    private function mapLigneVersAvis($ligne): Avis
    {
        return new Avis(
            utilisateurId: $ligne->utilisateur_id,
            commandeId: $ligne->commande_id,
            note: $ligne->note,
            commentaire: $ligne->commentaire,
            dateAvis: $ligne->date_avis
        );
    }
}