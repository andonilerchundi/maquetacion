<?php

namespace App\Models\DB;

class IVA extends DBModel
{

    protected $table = 't_iva';
    protected $with = ['product'];

    public function product()
    {
        return $this->hasMany(Product::class, 'iva');
    }
}