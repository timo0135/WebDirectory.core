<?php
namespace webDirectory\api\core\domain\entities;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model{
    protected $table = 'departement';
    protected $primaryKey = 'id';
    public $timestamps = false;


    function entree2Departement(){
        return $this->belongsToMany('webDirectory\api\core\domain\entities\Entree', 'entree2Departement',
            'departement_id',
            'entree_id'
        );
    }
}

