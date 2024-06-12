<?php

namespace webDirectory\api\core\services\departement;

use webDirectory\api\core\domain\entities\Entree;

class DepartementService implements DepartementServiceInterface {

    public function getEntrees() : array {
        return Entree::all()->toArray();
    }

    public function getDepartementbyEntrees($idEntree) : array {
        $entree = Entree::findorfail();
        return $entree->entree2Departement()->get()->toArray();
    }
}