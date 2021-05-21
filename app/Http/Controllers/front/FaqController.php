<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Vendor\Locale\Locale;
use App\Models\DB\Faq;
use App;
use Debugbar;


class FaqController extends Controller
{
    protected $agent;
    protected $faq;
    protected $locale;

    function __construct(Faq $faq, Locale $locale, Agent $agent)
    {
        $this->agent = $agent;
        $this->faq = $faq;
        $this->locale = $locale;
        
        $this->locale->setParent('faqs');
        $this->locale->setLanguage(App::getLocale());
    }

    public function index()
    {        
        
        

        $faqs = $this->faq->where('active', 1)->with('image_featured_desktop')->with('image_grid_desktop')->get();
         
     

        $faqs = $faqs->each(function($faq) {  
            
            $faq['locale'] = $faq->locale->pluck('value','tag');
            
            return $faq;
        });

        Debugbar::info($faqs);


        $view = View::make('front.faqs.index')
                ->with('faqs', $faqs );

        return $view;
    }

}

    