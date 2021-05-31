<?php

namespace App\Vendor\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Debugbar;

class Product extends Model
{
    protected $table = 't_products';
    protected $guarded = [];

    public function scopeGetValues($query, $rel_parent, $key){

        return $query->where('key', $key)
            ->where('rel_parent', $rel_parent);
    }

}
