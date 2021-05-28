<?php

namespace App\Models\DB;

class Brand extends DBModel
{

    protected $table = 't_brand';
    

    public function products()
    {
        return $this->hasMany(Glove::class, 'brand_id');
    }
}
