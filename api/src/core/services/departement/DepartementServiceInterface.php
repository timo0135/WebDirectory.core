<?php

namespace webDirectory\api\core\services\departement;

interface DepartementServiceInterface {
    public function getEntreesByDepartement(int $departement_id): array;
    public function getDepartementByEntree(string $entree_id): array;
    public function getDepartements(): array; // Méthode qui retourne la liste de départements
    public function getDepartementById(int $id): array; // Méthode qui retourne un département par son id
    public function getEntrees(): array;
    public function getEntreesBySearch(string $search): array; // Méthode qui retourne les entrées correspondant à une recherche
    public function getEntreesByDepartementSearch(int $departement_id, string $search): array;
    public function getEntreeById(string $id): array;
    public function getEntreesByDepartementOrder(int $departement_id, string $order, string $colum): array;
    public function getDepartementsOrder(string $order, string $colum): array;
    public function getEntreesOrder(string $order, string $colum ): array;
    public function getEntreesBySearchOrder(string $search, string $order, string $colum): array;
}