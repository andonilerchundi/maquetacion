<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\Brand as DBBrand;

class Brand
{
    static $composed;

    public function __construct(DBBrand $brand)
    {
        $this->brand = $brand;
    }

    public function compose(View $view)
    {

        if(static::$composed)
        {
            return $view->with('brand', static::$composed);
        }

        static::$composed = $this->brand->where('active', 1)->orderBy('name', 'asc')->get();

        $view->with('brand', static::$composed);

    }
}