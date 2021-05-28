<?php

namespace App\Models\DB;

class Oz extends DBModel
{

    protected $table = 't_oz';
    protected $with = ['gloves'];

    public function gloves()
    {
        return $this->hasMany(Glove::class, 'oz_id');
    }
}
