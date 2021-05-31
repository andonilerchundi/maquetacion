<?php

namespace App\Models\DB;

class GlovesOz extends DBModel
{

    protected $table = 't_gloves_oz';
    protected $with = ['glove'];

    public function glove()
    {
        return $this->hasOne(Glove::class, 'id', 'glove_id');
    }

    public function oz()
    {
        return $this->hasOne(Oz::class, 'id', 'oz_id');
    }
}
