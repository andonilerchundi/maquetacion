<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Vendor\Locale\Locale;
use App\Vendor\Locale\LocaleSlugSeo;
use App\Models\DB\Glove;
use App;
use Debugbar;


class GloveController extends Controller
{
    protected $agent;
    protected $glove;
    protected $locale;
    protected $locale_slug_seo;

    function __construct(Glove $glove, Locale $locale, Agent $agent,LocaleSlugSeo $locale_slug_seo)
    {
        $this->agent = $agent;
        $this->glove = $glove;
        $this->locale = $locale;
        $this->locale_slug_seo = $locale_slug_seo;
        
        $this->locale_slug_seo->setLanguage(app()->getLocale()); 
        $this->locale_slug_seo->setParent('gloves');    
    }

    public function index()
    {        
        $seo = $this->locale_slug_seo->getByKey(Route::currentRouteName());
        
        if($this->agent->isDesktop()){
            $gloves = $this->glove
                    ->with('image_featured_desktop')
                    ->where('active', 1)
                    ->get();
        }
         
        elseif($this->agent->isMobile()){
            $gloves = $this->glove
                    ->with('image_featured_mobile')
                    ->where('active', 1)
                    ->get();
        }
     

        $gloves = $gloves->each(function($glove) {  
            
            $glove['locale'] = $glove->locale->pluck('value','tag');
            
            return $glove;
        });

        $view = View::make('front.gloves.index')
                ->with('gloves', $gloves)
                ->with('seo', $seo );

        return $view;
    }

    public function show($slug)
    {      
        $seo = $this->locale_slug_seo->getIdByLanguage($slug);

        if(isset($seo->key)){

            if($this->agent->isDesktop()){
                $glove = $this->glove
                    ->with('image_featured_desktop')
                    ->with('image_grid_desktop')
                    ->where('active', 1)
                    ->find($seo->key);
            }
            
            elseif($this->agent->isMobile()){
                $glove = $this->glove
                    ->with('image_featured_mobile')
                    ->with('image_grid_mobile')
                    ->where('active', 1)
                    ->find($seo->key);
            }

            $glove['locale'] = $glove->locale->pluck('value','tag');

            $view = View::make('front.gloves.single')->with('glove', $glove);

            
            if(request()->ajax()) {

                $sections = $view->renderSections(); 
        
                return response()->json([
                    'table' => $sections['table'],
                    'form' => $sections['form'],
                ]); 
            }

            
            return $view;

        }else{
            return response()->view('errors.404', [], 404);
        }
    }
}

    