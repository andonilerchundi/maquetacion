<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\Oz as DBOZ;

class Oz
{
    static $composed;

    public function __construct(DBOZ $oz)
    {
        $this->oz = $oz;
    }

    public function compose(View $view)
    {

        if(static::$composed)
        {
            return $view->with('oz', static::$composed);
        }

        static::$composed = $this->oz->where('active', 1)->orderBy('oz', 'asc')->get();

        $view->with('oz', static::$composed);

    }
}