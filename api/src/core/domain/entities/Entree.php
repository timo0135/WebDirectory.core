<?php
namespace webDirectory\api\core\domain\entities;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Entree extends Model{
    use HasUuids;
    protected $table = 'entree';

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    function entree2Departement(){
        return $this->belongsToMany('webDirectory\api\core\domain\entities\Departement', 'entree2Departement',
            'entree_id',
            'departement_id'
        )->withPivot(
            ['quantite']
        );
    }

}

