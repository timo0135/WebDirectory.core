<?php

namespace webDirectory\api\core\services\departement;

interface DepartementServiceInterface {

    public function getDepartements(): array; // Méthode qui retourne la liste de départements
    public function getDepartementsById(int $id): array; // Méthode qui retourne un département par son id
    public function getEntrees(): array;
    public function getDepartementByEntree(string $entree_id): array;
}