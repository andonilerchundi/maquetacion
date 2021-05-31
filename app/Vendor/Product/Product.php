<?php

namespace App\Vendor\Product;

use App\Vendor\Product\Models\Product as DBProduct;
use App\Vendor\Locale\Models\LocaleLanguage;

class Product
{
    protected $rel_parent;
    protected $language;

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
    
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function store($product, $key)
    {  

        $product[] = $this->product->updateOrCreate([
            'key' => $key,
            'rel_parent' => $this->rel_parent],[
            'rel_parent' => $this->rel_parent,
            'color'=> $color,
            'price'=> $price,
            'iva_id'=> $iva,
            'total_price '=> $price + ($price * $iva),
        ]);

        return $product;
    }

    public function show($key)
    {
        return DBProduct::getValues($this->rel_parent, $key);
    }

    public function delete($key)
    {
        if (DBProduct::getValues($this->rel_parent, $key)->count() > 0) {

            DBProduct::getValues($this->rel_parent, $key)->delete();   
        }
    }

    public function getIdByLanguage($key){ 
        return DBProduct::getIdByLanguage($this->rel_parent, $this->language, $key)->pluck('color')->all();
    }

    public function getAllByLanguage(){ 

        $items = DBProduct::getAllByLanguage($this->rel_parent, $this->language)->get()->groupBy('key');

        $items =  $items->map(function ($item) {
            return $item->pluck('value','tag');
        });

        return $items;
    }
}