<?php

namespace gift\admin\core\domain\entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasUuids;
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    public $keyType = 'string';

}