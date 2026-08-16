<?php
// AvisRepositoryInterface.php
interface AvisRepositoryInterface {
    public function getById(int $avisId): ?Avis;

    public function getAll(): array;

    public function getByNote(int $note): array;

    public function getByUtilisateurId(int $utilisateurId): array;

    public function save(Avis $avis): void;

    public function delete(int $avisId): void;
}


