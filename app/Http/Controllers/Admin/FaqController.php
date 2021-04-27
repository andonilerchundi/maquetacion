<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Http\Requests\Admin\FaqRequest;
use App\Models\DB\Faq;

class FaqController extends Controller
{
    protected $agent;
    protected $faq;

    function __construct(Faq $faq, Agent $agent)
    {
        $this->middleware('auth');
        $this->agent = $agent;
        $this->faq = $faq;
    }

    public function index()
    {

        if($this->agent->isDesktop()){
            $view = View::make('admin.faqs.index')
            ->with('faq', $this->faq)
            ->with('faqs', $this->faq->where('active', 1)->paginate(12));
        }

        if($this->agent->isMobile()){
            $view = View::make('admin.faqs.index')
            ->with('faq', $this->faq)
            ->with('faqs', $this->faq->where('active', 1)->paginate(7));
        }

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
            'title' => request('title'),
            'description' => request('description'),
            'category_id' => request('category_id'),
            'active' => 1,
        ]);

        if (request('id')){
            $message = \Lang::get('admin/faqs.faq-update');
        }else{
            $message = \Lang::get('admin/faqs.faq-create');
        }

        if($this->agent->isDesktop()){
            $view = View::make('admin.faqs.index')
            ->with('faqs', $this->faq->where('active', 1)->paginate(12))
            ->with('faq', $faq)
            ->renderSections();

        }

        if($this->agent->isMobile()){
            $view = View::make('admin.faqs.index')
            ->with('faqs', $this->faq->where('active', 1)->paginate(7))
            ->with('faq', $faq)
            ->renderSections();

        }

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'id' => $faq->id,
            'message' => $message,
        ]);
    }

    public function show(Faq $faq)
    {
        if($this->agent->isDesktop()){

            $view = View::make('admin.faqs.index')
            ->with('faq', $faq)
            ->with('faqs', $this->faq->where('active', 1)->paginate(12)); 
        }
        if($this->agent->isMobile()){

            $view = View::make('admin.faqs.index')
            ->with('faq', $faq)
            ->with('faqs', $this->faq->where('active', 1)->paginate(7)); 
        }
         
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function destroy(Faq $faq)
    {
        $faq->active = 0;
        $faq->save();

        // $faq->delete();

        if($this->agent->isDesktop()){
            $view = View::make('admin.faqs.index')
            ->with('faq', $this->faq)
            ->with('faqs', $this->faq->where('active', 1)->paginate(12))
            ->renderSections();
        
            return response()->json([
                'table' => $view['table'],
                'form' => $view['form']
            ]);


        }
        if($this->agent->isMobile()){
            $view = View::make('admin.faqs.index')
            ->with('faq', $this->faq)
            ->with('faqs', $this->faq->where('active', 1)->paginate(7))
            ->renderSections();
        
            return response()->json([
                'table' => $view['table'],
                'form' => $view['form']
            ]);


        }



        
    }
    public function filter(Request $request){

        $query = $this->faq->query();

        $query->when(request('category_id'), function ($q, $category_id) {

            if($category_id == 'all'){
                return $q;
            }
            else {
                return $q->where('category_id', $category_id);
            }
        });
        

        $query->when(request('search'), function ($q, $search) {

            if($search == null){
                return $q;
            }
            else {
                return $q->where('title', 'like', "%$search%");
            }
        });

        $query->when(request('created_at_from'), function ($q, $created_at_from) {

            if($created_at_from == null){
                return $q;
            }
            else {
                $q->whereDate('created_at', '>=',  $created_at_from);
            }
        });

        $query->when(request('created_at_since'), function ($q, $created_at_since) {

            if( $created_at_since == null){
                return $q;
            }
            else {
                $q->whereDate('created_at', '<=',  $created_at_since);
            }
        });
        
        if($this->agent->isDesktop()){
            $faqs = $query->where('active', 1)->paginate(12);

        }
        if($this->agent->isDesktop()){
            $faqs = $query->where('active', 1)->paginate(7);

        }
        

        $view = View::make('admin.faqs.index')
            ->with('faqs', $faqs)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
        ]);
    }
}

    