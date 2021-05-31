<?php

namespace App\Models\DB;

class Brand extends DBModel
{

    protected $table = 't_brand';
    protected $with = ['gloves'];

    public function gloves()
    {
        return $this->hasMany(Glove::class, 'brand_id');
    }
}
