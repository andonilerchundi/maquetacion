<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Http\Requests\Admin\SliderRequest;
use App\Models\DB\Slider;

class SliderController extends Controller
{
    protected $agent;
    protected $slider;

    function __construct(Slider $slider, Agent $agent)
    {
        $this->middleware('auth');
        $this->agent = $agent;
        $this->slider = $slider;
    }

    public function index()
    {

        if($this->agent->isDesktop()){
            $view = View::make('admin.sliders.index')
            ->with('slider', $this->slider)
            ->with('sliders', $this->slider->where('active', 1)->paginate(12));
        }

        if($this->agent->isMobile()){
            $view = View::make('admin.sliders.index')
            ->with('slider', $this->slider)
            ->with('sliders', $this->slider->where('active', 1)->paginate(7));
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

        $view = View::make('admin.sliders.index')
        ->with('slider', $this->slider)
        ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }

    public function store(SliderRequest $request)
    {            
        $slider = $this->slider->updateOrCreate([
            'id' => request('id')],[
            'name' => request('name'),
            'entity' => request('entity'),
            'visible' => request('visible') == 'true' ? 1 : 0,
            'active' => 1,
        ]);

        if (request('id')){
            $message = \Lang::get('admin/sliders.slider-update');
        }else{
            $message = \Lang::get('admin/sliders.slider-create');
        }

        if($this->agent->isDesktop()){
            $view = View::make('admin.sliders.index')
            ->with('sliders', $this->slider->where('active', 1)->paginate(12))
            ->with('slider', $slider)
            ->renderSections();

        }

        if($this->agent->isMobile()){
            $view = View::make('admin.sliders.index')
            ->with('sliders', $this->slider->where('active', 1)->paginate(7))
            ->with('slider', $slider)
            ->renderSections();

        }

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'id' => $slider->id,
            'message' => $message,
        ]);
    }

    public function show(Slider $slider)
    {
        if($this->agent->isDesktop()){

            $view = View::make('admin.sliders.index')
            ->with('slider', $slider)
            ->with('sliders', $this->slider->where('active', 1)->paginate(12)); 
        }
        if($this->agent->isMobile()){

            $view = View::make('admin.sliders.index')
            ->with('slider', $slider)
            ->with('sliders', $this->slider->where('active', 1)->paginate(7)); 
        }
         
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function destroy(Slider $slider)
    {
        $slider->active = 0;
        $slider->save();

        // $slider->delete();

        if($this->agent->isDesktop()){
            $view = View::make('admin.sliders.index')
            ->with('slider', $this->slider)
            ->with('sliders', $this->slider->where('active', 1)->paginate(12))
            ->renderSections();
        
            return response()->json([
                'table' => $view['table'],
                'form' => $view['form']
            ]);


        }
        if($this->agent->isMobile()){
            $view = View::make('admin.sliders.index')
            ->with('slider', $this->slider)
            ->with('sliders', $this->slider->where('active', 1)->paginate(7))
            ->renderSections();
        
            return response()->json([
                'table' => $view['table'],
                'form' => $view['form']
            ]);


        }



        
    }
    public function filter(Request $request,$filters = null){

        $filters = json_decode($request->input('filters'));
        $query = $this->slider->query();

        $query->when($filters->search, function ($q, $search) {

            if($search == null){
                return $q;
            }
            else {
                return $q->where('name', 'like', "%$search%");
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
        
        if($this->agent->isDesktop()){
            $sliders = $query->where('active', 1)
            ->paginate(12)
            ->appends(['filters' => json_encode($filters)]);

        }
        if($this->agent->isDesktop()){
            $sliders = $query->where('active', 1)
            ->paginate(7)
            ->appends(['filters' => json_encode($filters)]);

        }
        

        $view = View::make('admin.sliders.index')
            ->with('sliders', $sliders)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
        ]);
    }
}