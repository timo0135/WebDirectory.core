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
        // contre les injections
        if ($entree['lastname'] !== filter_var($entree['lastname'], FILTER_SANITIZE_SPECIAL_CHARS)
            || $entree['firstname'] !== filter_var($entree['firstname'], FILTER_SANITIZE_SPECIAL_CHARS) ||
            $entree['fonction'] !== filter_var($entree['fonction'], FILTER_SANITIZE_SPECIAL_CHARS) ||
            $entree['Desktop'] !== filter_var($entree['Desktop'], FILTER_SANITIZE_SPECIAL_CHARS) ||
            $entree['phone1'] !== filter_var($entree['phone1'], FILTER_SANITIZE_SPECIAL_CHARS) ||
            $entree['phone2'] !== filter_var($entree['phone2'], FILTER_SANITIZE_SPECIAL_CHARS) ||
            $entree['email'] !== filter_var($entree['email'], FILTER_SANITIZE_SPECIAL_CHARS)){
            throw new DepartementServiceBadDataException("Donnée suspecte");
        }
        $e = new Entree();
        $e->nom = $entree['lastname'];
        $e->prenom = $entree['firstname'];
        $e->fonction = $entree['fonction'];
        $e->numeroBureau = $entree['Desktop'];
        $e->numeroTel1 = $entree['phone1'];
        $e->numeroTel2 = $entree['phone2'] === '' ? null : $entree['phone2'];
        $e->email = $entree['email'];
        $e->image = 'person.png';
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
        if ($departement['name'] !== filter_var($departement['name'], FILTER_SANITIZE_SPECIAL_CHARS)
            || $departement['etage'] !== filter_var($departement['etage'], FILTER_SANITIZE_SPECIAL_CHARS) ||
            $departement['description'] !== filter_var($departement['description'], FILTER_SANITIZE_SPECIAL_CHARS)){
            throw new DepartementServiceBadDataException("Donnée suspecte");
        }
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

    public function changeEntreeStatut(string $entree_id): void
    {
        try{
            $entree = Entree::findOrFail($entree_id);
            if ($entree->statut == 1) {
                $entree->statut = 0;
            } else {
                $entree->statut = 1;
            }
            $entree->save();
        }catch (\Exception $e){
            throw new DepartementServiceNotFoundException("Entree not found");
        }
    }

    public function getDepartements(): array
    {
        return Departement::all()->toArray();
    }
}