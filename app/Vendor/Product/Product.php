<?php

namespace App\Vendor\Product;

use App\Vendor\Product\Models\Product as DBProduct;
use Debugbar;

class Product
{
    protected $rel_parent;
    

    function __construct(DBProduct $product)
    {
        $this->product = $product;
    }

    public function setParent($rel_parent)
    {
        $this->rel_parent = $rel_parent;
    }

    public function getParent()
    {
        return $this->rel_parent;
    }
    

    public function store($product, $key)
    {  
        $product[] = $this->product->updateOrCreate([
            'key' => $key,
            'rel_parent' => $this->rel_parent],[
            'rel_parent' => $this->rel_parent,
            'price'=> $product['total_price'] / (1 + $product['iva'] ),
            'iva'=>$product['iva'] ,
            'total_price'=>$product['total_price'],
        ]);

        return $product;
    }

    public function show($key)
    {
        return DBProduct::getValues($this->rel_parent, $key)->first();

    }

    public function delete($key)
    {
        if (DBProduct::getValues($this->rel_parent, $key)->count() > 0) {

            DBProduct::getValues($this->rel_parent, $key)->delete();   
        }
    }


}