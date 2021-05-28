<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\Gloves;

class Gloves
{
    static $composed;

    public function __construct(Gloves $gloves)
    {
        $this->gloves = $gloves;
    }

    public function compose(View $view)
    {

        if(static::$composed)
        {
            return $view->with('gloves', static::$composed);
        }

        static::$composed = $this->gloves->where('active', 1)->orderBy('name', 'asc')->get();

        $view->with('gloves', static::$composed);

    }
}