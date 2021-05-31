<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Http\Requests\Admin\GloveRequest;
use App\Vendor\Locale\Locale;
use App\Vendor\Locale\LocaleSlugSeo;
use App\Models\DB\Glove; 
use App\Models\DB\GlovesOz; 
use App\Vendor\Image\Image;
use App\Vendor\Product\Product;
use Debugbar;

class GloveController extends Controller
{
    protected $agent;
    protected $locale;
    protected $image;
    protected $glove;
    protected $locale_slug_seo;
    protected $product;
    protected $glovesoz;
   


    function __construct(Glove $glove, GlovesOz $glovesoz, Agent $agent, Locale $locale, Image $image, LocaleSlugSeo $locale_slug_seo, Product $product)
    {
        // $this->middleware('auth');
        $this->agent = $agent;
        $this->locale = $locale;
        $this->image = $image;
        $this->glove = $glove;
        $this->locale_slug_seo = $locale_slug_seo;
        $this->product = $product;
        $this->glovesoz = $glovesoz;

        if ($this->agent->isMobile()) {
            $this->paginate = 9;
        }

        if ($this->agent->isDesktop()) {
            $this->paginate = 12;
        }

        $this->locale->setParent('gloves');
        $this->image->setEntity('gloves');
        $this->locale_slug_seo->setParent('gloves');
        $this->product->setParent('gloves');
    }

    public function index()
    {
        $view = View::make('admin.gloves.index')
        ->with('glove', $this->glove)
        ->with('gloves', $this->glove->where('active', 1)
        ->paginate($this->paginate));

        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'table' => $sections['table'],
                'form' => $sections['form'],
            ]); 
        }

        return $view;
    }

    public function create()
    {

        $view = View::make('admin.gloves.index')
        ->with('glove', $this->glove)
        ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }

    public function store(GloveRequest $request)
    {   

        $glove = $this->glove->updateOrCreate([
            'id' => request('id')],[
            'name' => request('name'),
            'brand_id'=>request('brand_id'),
            'color' => request('color'),
            'active' => 1,
        ]);

        if(request('oz')){
            $oz  = $this->storeOz(request('oz'), $glove->id);
        }

        if(request('seo')){
            $seo = $this->locale_slug_seo->store(request('seo'), $glove->id, 'front_gloves');
        }

        if(request('locale')){
            $locale = $this->locale->store(request('locale'), $glove->id);
        }
        if(request('product')){
            $product = $this->product->store(request('product'), $glove->id);
        }
        if(request('images')){
            $images = $this->image->store(request('images'), $glove->id);
        }

        if (request('id')){
            $message = \Lang::get('admin/gloves.gloves-update');
        }else{
            $message = \Lang::get('admin/gloves.gloves-create');
        }

        $view = View::make('admin.gloves.index')
        ->with('gloves', $this->glove->where('active', 1)
        ->paginate($this->paginate))
        ->with('glove', $glove)
        ->with('product', $product)
        ->with('locale', $locale)
        ->renderSections(); 

       
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'id' => $glove->id,
            'message' => $message,
        ]);
    }

    public function edit(glove $glove)
    {
        // $locale = $this->locale->show($glove->id);
        // $seo = $this->locale_slug_seo->show($glove->id);

        // $view = View::make('admin.gloves.index')
        // ->with('locale', $locale)
        // ->with('seo', $seo)
        // ->with('glove', $glove)
        // ->with('gloves', $this->glove->where('active', 1)->orderBy('created_at', 'desc')->paginate($this->paginate));        
        
        // if(request()->ajax()) {

        //     $sections = $view->renderSections(); 
    
        //     return response()->json([
        //         'table' => $sections['table'],
        //         'form' => $sections['form'],
        //     ]); 
        // }
                
        // return $view;
    }

    public function show(Glove $glove)
    {
        $product = $this->product->show($glove->id);
        $locale = $this->locale->show($glove->id);
        Debugbar::info($product);
        $seo = $this->locale_slug_seo->show($glove->id);

        $view = View::make('admin.gloves.index')
        ->with('locale', $locale)
        ->with('seo', $seo)
        ->with('product', $product)
        ->with('glove', $glove)
        ->with('gloves', $this->glove->where('active', 1)->paginate($this->paginate))
        ->renderSections();   

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
        ]);
                
        return $view;
    }

    public function destroy(Glove $glove)
    {
        $glove->active = 0;
        $glove->save();

        $view = View::make('admin.gloves.index')
        ->with('glove', $this->glove)
        ->with('gloves', $this->glove->where('active', 1)
        ->paginate($this->paginate))
        ->renderSections(); 

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);
        
    }

    public function storeOz($ozs, $id)
    {  

        foreach($ozs as $oz){
            
            $ozs[] = $this->glovesoz->updateOrCreate([
                'glove_id' => $id,
                'oz_id' => $oz],[
            ]);
        }
        
        return $oz;
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

        $query->when($filters->brand_id, function ($q, $brand_id) {

            if($brand_id == 'all'){
                return $q;
            }
            else {
                return $q->where('brand_id', $brand_id);
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

    