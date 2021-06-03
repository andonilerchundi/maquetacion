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
                    'product' => $sections['content'],
                ]); 
            }

            
            return $view;

        }else{
            return response()->view('errors.404', [], 404);
        }
    }


    public function filter(Request $request, $filters = null){

        $filters = json_decode($request->input('filters'));
        $query = $this->glove->query();

        $query->when($filters->oz_id, function ($q, $oz_id) {

            if($oz_id == 'all'){
                return $q;
            }
            else {
                return $q->where('oz_id', $oz_id);
            }
        });

        $query->when($filters->brand_name, function ($q, $brand_name) {

            if($brand_name == 'all'){
                return $q;
            }
            else {
                return $q->where('brand_name', $brand_name);
            }
        });

        $query->when($filters->total_price, function ($q, $total_price) {

            if($total_price == 'all'){
                return $q;
            }
            else {
                return $q->where('total_price', $total_price);
            }
        });
        

        $query->when($filters->created_at_from, function ($q, $created_at_from) {

            if($created_at_from == null){
                return $q;
            }
            else {
                $q->whereDate('created_at', '>=',  $created_at_from);
            }
        });

        $query->when($filters->created_at_since, function ($q, $created_at_since) {

            if( $created_at_since == null){
                return $q;
            }
            else {
                $q->whereDate('created_at', '<=',  $created_at_since);
            }
        });
        
        

        
        $gloves = $query->where('active', 1)
        ->paginate($this->paginate)
        ->appends(['filters' => json_encode($filters)]);

        
        
        $view = View::make('admin.gloves.index')
            ->with('gloves', $gloves)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
        ]);
    }


}

    