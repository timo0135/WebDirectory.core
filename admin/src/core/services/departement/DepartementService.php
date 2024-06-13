<?php

namespace webDirectory\admin\core\services\departement;

use webDirectory\admin\core\domain\entities\Departement;
use webDirectory\admin\core\domain\entities\Entree;

class DepartementService implements DepartementServiceInterface {


    public function getEntreesByDepartement(int $departement_id): array
    {
        try{
            $departement = Departement::findOrFail($departement_id);
            return $departement->entree2Departement()->get()->toArray();
        }catch (\Exception $e){
            throw new DepartementServiceNotFoundException("Departement not found");
        }

    }

    public function getDepartementByEntree(string $entree_id): array
    {
        try{
            $entree = Entree::findOrFail($entree_id);
            return $entree->entree2Departement()->get()->toArray();
        }catch (\Exception $e){
            throw new DepartementServiceNotFoundException("Departement not found");
        }
    }

    public function createEntree(array $entree, array $departement): string
    {
        $img = strtolower($entree['lastname']).'png';
        $e = new Entree();
        $e->nom = $entree['lastname'];
        $e->prenom = $entree['firstname'];
        $e->fonction = $entree['fonction'];
        $e->numeroBureau = $entree['Desktop'];
        $e->numeroTel1 = $entree['phone1'];
        $e->numeroTel2 = $entree['phone2'] ?? null;
        $e->email = $entree['email'];
        $e->image = $img;
        $e->statut = 1;
        $e->save();
        foreach ($departement as $key => $value){
            $d = Departement::where('nom', $value)->first();
            $e->entree2Departement()->attach($d->id);
        }
        return $e->id;
    }

    public function createDepartement(array $departement): int
    {
        $d = new Departement();
        $d->nom = $departement['name'];
        $d->etage = $departement['etage'];
        $d->description = $departement['description'];
        $d->save();
        return $d->id;
    }

    public function getEntrees(): array
    {
        return Entree::all()->toArray();
    }
}