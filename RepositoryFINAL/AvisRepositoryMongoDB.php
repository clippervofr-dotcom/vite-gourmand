<?php

class AvisRepositoryMongoDB implements AvisRepositoryInterface {

    private MongoDB\Driver\Manager $manager;

    public function __construct(MongoDB\Driver\Manager $manager)
    {
        $this->manager = $manager;
    }

    public function getByNote(int $note): array {
        $filter = ['note' => $note];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $this->manager->executeQuery('vite_et_gourmand.avis', $query);

        $avisList = [];
        foreach ($cursor as $result) {
            $avisList[] = $this->mapLigneVersAvis($result);
        }
        return $avisList;
    }

    public function getByUtilisateurId(int $utilisateurId): array {
        $filter = ['utilisateur_id' => $utilisateurId];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $this->manager->executeQuery('vite_et_gourmand.avis', $query);

        $avisList = [];
        foreach ($cursor as $result) {
            $avisList[] = $this->mapLigneVersAvis($result);
        }
        return $avisList;
    }

    public function getByDateAvis(string $dateAvis): array {

        $filter = ['date_avis' => $dateAvis];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $this->manager->executeQuery('vite_et_gourmand.avis', $query);

        $avisList = [];
        foreach ($cursor as $result) {
            $avisList[] = $this->mapLigneVersAvis($result);
        }
        return $avisList;
    }

    public function getByCommandeId(int $commandeId): array {
        $filter = ['commande_id' => $commandeId];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $this->manager->executeQuery('vite_et_gourmand.avis', $query);

        $avisList = [];
        foreach ($cursor as $result) {
            $avisList[] = $this->mapLigneVersAvis($result);
        }
        return $avisList;
    }

    public function getAll(): array
    {
        $query = new MongoDB\Driver\Query([]);
        $cursor = $this->manager->executeQuery('vite_et_gourmand.avis', $query);

        $avisList = [];
        foreach ($cursor as $result) {
            $avisList[] = $this->mapLigneVersAvis($result);
        }
        return $avisList;
    }

    public function save(Avis $avis): void {
        $bulk = new MongoDB\Driver\BulkWrite;
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

    public function delete(int $commandeId): void {
        $bulk = new MongoDB\Driver\BulkWrite;
        $filter = ['commande_id' => $commandeId];
        $bulk->delete($filter);
        $this->manager->executeBulkWrite('vite_et_gourmand.avis', $bulk);
    }

    private function mapLigneVersAvis($ligne): Avis {
        return new Avis(
            utilisateurId: $ligne->utilisateur_id,
            commandeId: $ligne->commande_id,
            note: $ligne->note,
            commentaire: $ligne->commentaire,
            dateAvis: $ligne->date_avis
        );
    }
}