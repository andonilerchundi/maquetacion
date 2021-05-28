<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\IVA as DBIVA;

class IVA
{
    static $composed;

    public function __construct(DBIVA $iva)
    {
        $this->iva = $iva;
    }

    public function compose(View $view)
    {

        if(static::$composed)
        {
            return $view->with('iva', static::$composed);
        }

        static::$composed = $this->iva->where('active', 1)->orderBy('iva', 'asc')->get();

        $view->with('iva', static::$composed);

    }
}