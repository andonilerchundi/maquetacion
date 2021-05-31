<?php

namespace App\Models\DB;

class Oz extends DBModel
{

    protected $table = 't_oz';
    protected $with = ['glovesoz'];

    public function glovesoz()
    {
        return $this->hasMany(GlovesOz::class, 'oz_id');
    }
}
