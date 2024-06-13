<?php
namespace webDirectory\admin\core\domain\entities;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model{
    protected $table = 'departement';
    protected $primaryKey = 'id';
    public $timestamps = false;


    function entree2Departement(){
        return $this->belongsToMany('webDirectory\admin\core\domain\entities\Entree', 'entree2Departement',
            'departement_id',
            'entree_id'
        );
    }
}

