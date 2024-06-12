<?php

namespace webDirectory\api\core\services\departement;

use webDirectory\api\core\domain\entities\Departement;

class DepartementService implements DepartementServiceInterface {

    /**
     * Méthode qui retourne la liste de départements
     * 
     * @return array
     */
    public function getDepartements(): array
    {
        return Departement::all()->toArray();
    }

    /**
     * Méthode qui retourne un département par son id
     * 
     * @param int $id
     * @return array
     */
    public function getDepartementsById(int $id): array
    {
        try {
            $departement = Departement::findOrFail($id);
        } catch (\Exception $e) {
            throw new DepartementServiceNotFoundException("Le département $id n'existe pas");
        }
        return $departement->toArray();
    }
}