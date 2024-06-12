<?php

namespace webDirectory\api\core\services\departement;

class DepartementService implements DepartementServiceInterface {

    public function getEntreeByID($id) : array
    {
        try {
            $entree = Entree::findOrFail($id);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return $entree->toArray();
    }
}