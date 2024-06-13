<?php

namespace webDirectory\admin\core\services\departement;

interface DepartementServiceInterface {
    public function getEntreesByDepartement(int $departement_id): array;
    public function getDepartementByEntree(string $entree_id): array;
    public function createEntree(array $entree, array $departement): string;

    
}