<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Http\Requests\Admin\FaqRequest;
use App\Vendor\Locale\Locale;
use App\Vendor\Locale\LocaleSlugSeo;
use App\Models\DB\Faq; 
use App\Vendor\Image\Image;
use Debugbar;

class FaqController extends Controller
{
    protected $agent;
    protected $locale;
    protected $image;
    protected $faq;
    protected $locale_slug_seo;
   


    function __construct(Faq $faq, Agent $agent, Locale $locale, Image $image, LocaleSlugSeo $locale_slug_seo)
    {
        $this->middleware('auth');
        $this->agent = $agent;
        $this->locale = $locale;
        $this->image = $image;
        $this->faq = $faq;
        $this->locale_slug_seo = $locale_slug_seo;

        if ($this->agent->isMobile()) {
            $this->paginate = 9;
        }

        if ($this->agent->isDesktop()) {
            $this->paginate = 12;
        }

        $this->locale->setParent('faqs');
        $this->image->setEntity('faqs');
        $this->locale_slug_seo->setParent('faqs');
    }

    public function index()
    {
        $view = View::make('admin.faqs.index')
        ->with('faq', $this->faq)
        ->with('faqs', $this->faq->where('active', 1)
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

        $view = View::make('admin.faqs.index')
        ->with('faq', $this->faq)
        ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }

    public function store(FaqRequest $request)
    {    
       
        $faq = $this->faq->updateOrCreate([
            'id' => request('id')],[
            'name' => request('name'),
            'category_id' => request('category_id'),
            'active' => 1,
        ]);

        if(request('seo')){
            $seo = $this->locale_slug_seo->store(request('seo'), $faq->id, 'front_faq');
        }

        if(request('locale')){
            $locale = $this->locale->store(request('locale'), $faq->id);
        }
        if(request('images')){
            $images = $this->image->store(request('images'), $faq->id);
        }

        if (request('id')){
            $message = \Lang::get('admin/faqs.faq-update');
        }else{
            $message = \Lang::get('admin/faqs.faq-create');
        }

        $view = View::make('admin.faqs.index')
        ->with('faqs', $this->faq->where('active', 1)
        ->paginate($this->paginate))
        ->with('faq', $faq)
        ->with('locale', $locale)
        ->renderSections(); 

       
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'id' => $faq->id,
            'message' => $message,
        ]);
    }

    public function edit(Faq $faq)
    {
        // $locale = $this->locale->show($faq->id);
        // $seo = $this->locale_slug_seo->show($faq->id);

        // $view = View::make('admin.faqs.index')
        // ->with('locale', $locale)
        // ->with('seo', $seo)
        // ->with('faq', $faq)
        // ->with('faqs', $this->faq->where('active', 1)->orderBy('created_at', 'desc')->paginate($this->paginate));        
        
        // if(request()->ajax()) {

        //     $sections = $view->renderSections(); 
    
        //     return response()->json([
        //         'table' => $sections['table'],
        //         'form' => $sections['form'],
        //     ]); 
        // }
                
        // return $view;
    }

    public function show(Faq $faq)
    {
        $locale = $this->locale->show($faq->id);
        $seo = $this->locale_slug_seo->show($faq->id);

        $view = View::make('admin.faqs.index')
        ->with('locale', $locale)
        ->with('seo', $seo)
        ->with('faq', $faq)
        ->with('faqs', $this->faq->where('active', 1)->paginate($this->paginate))
        ->renderSections();   

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
        ]);
                
        return $view;
    }

    public function destroy(Faq $faq)
    {

        $this->locale->delete($faq->id);
        $this->locale_slug_seo->delete($faq->id);

        
        $faq->active = 0;
        $faq->save();

        // $faq->delete();

        $view = View::make('admin.faqs.index')
        ->with('faq', $this->faq)
        ->with('faqs', $this->faq->where('active', 1)
        ->paginate($this->paginate))
        ->renderSections(); 

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);

        
    }

    public function filter(Request $request, $filters = null){

        $filters = json_decode($request->input('filters'));
        $query = $this->faq->query();

        $query->when($filters->category_id, function ($q, $category_id) {

            if($category_id == 'all'){
                return $q;
            }
            else {
                return $q->where('category_id', $category_id);
            }
        });
        

        $query->when($filters->search, function ($q, $search) {

            if($search == null){
                return $q;
            }
            else {
                return $q->where('title', 'like', "%$search%");
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
        
        

        
        $faqs = $query->where('active', 1)
        ->paginate($this->paginate)
        ->appends(['filters' => json_encode($filters)]);

        
        
        $view = View::make('admin.faqs.index')
            ->with('faqs', $faqs)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
        ]);
    }
}

    