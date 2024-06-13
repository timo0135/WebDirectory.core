<?php

namespace webDirectory\api\core\services\departement;

use webDirectory\api\core\domain\entities\Departement;
use webDirectory\api\core\domain\entities\Entree;

class DepartementService implements DepartementServiceInterface {


    public function getEntreesByDepartement(int $departement_id): array
    {
        try{
            $departement = Departement::findOrFail($departement_id);
            return $departement->entree2Departement()->get()->where('statut', 1)->toArray();
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
            throw new DepartementServiceNotFoundException("Entree not found");
        }
    }
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
    public function getDepartementById(int $id): array
    {
        try {
            $departement = Departement::findOrFail($id);
        } catch (\Exception $e) {
            throw new DepartementServiceNotFoundException("Le département $id n'existe pas");
        }
        return $departement->toArray();
    }

    /**
     * Méthode qui retourne les entrées correspondant à une recherche
     *
     * @param string $search
     * @return array
     */
    public function getEntreesBySearch(string $search): array
    {
        try {
            $departements = Entree::where('nom', 'like', "%$search%")->where('statut', 1)->get();
        } catch (\Exception $e) {
            throw new DepartementServiceNotFoundException("Aucun département ne correspond à la recherche $search");
        }

        return $departements->toArray();
    }

    /**
     * Méthode qui recupère toutes les entrées
     *
     * @return array
     */

    public function getEntrees() : array {
        return Entree::where('statut', 1)->get()->toArray();
    }

    public function getEntreeById(string $entree_id): array
    {
        try{
            $entree = Entree::where('id', $entree_id)->where('statut', 1)->first();
            return $entree->toArray();
        }catch (\Exception $e){
            throw new DepartementServiceNotFoundException("Entree not found");
        }
    }

    public function getEntreesByDepartementOrder(int $departement_id, string $order, string $colum): array
    {
        try{
            if ($order !== 'asc' && $order !== 'desc'){
                throw new DepartementServiceNotFoundException("Order not found");
            }
            $departement = Departement::findOrFail($departement_id);
            return $departement->entree2Departement()->orderBy($colum, $order)->get()->where('statut', 1)->toArray();
        }catch (\Exception $e){
            throw new DepartementServiceNotFoundException("Departement not found");
        }
    }

    public function getDepartementsOrder(string $order, string $colum): array
    {
        if ($order === 'asc' || $order === 'desc'){
            return Departement::orderBy($colum, $order)->get()->toArray();
        }
        throw new DepartementServiceNotFoundException("Order not found");

    }

    public function getEntreesOrder(string $order, string $colum ): array
    {
        if ($order === 'asc' || $order === 'desc'){
            return Entree::orderBy($colum, $order)->where('statut', 1)->get()->toArray();
        }
        throw new DepartementServiceNotFoundException("Order not found");
    }

    public function getEntreesBySearchOrder(string $search, string $order, string $colum): array
    {
        if ($order !== 'asc' && $order !== 'desc'){
            throw new DepartementServiceNotFoundException("Order not found");
        }
        return Entree::where('nom', 'like', "%$search%")->where('statut', 1)->orderBy($colum, $order)->get()->toArray();
    }
}