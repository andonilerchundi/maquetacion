<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StockRequest;
use App\Models\DB\Stock;

class StockController extends Controller{

    function __construct(Stock $stock)
    {     
        $this->middleware('auth');     
        $this->stock = $stock;
    }

    public function index()
    {

        $view = View::make('admin.stock.index')
                ->with('stocks', $this->stock->where('active', 1)->get())
                ->with('stock', $this->stock);

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

        $view = View::make('admin.stock.index')
        ->with('stock', $this->stock)
        ->renderSections();

        return response()->json([
            'form' => $view['form'],
        ]);
    }

    public function store(StockRequest $request)
    {

        $stock = Stock::updateOrCreate([
            'id' => request('id')],[
            'name' => request('name'),
            'stock'=> request('stock'),
            'active' => 1,
        ]);

        $view = View::make('admin.stock.index')
        ->with('stocks', $this->stock->where('active', 1)->get())
        ->with('stock', $stock)
        ->renderSections();

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'id' => $stock->id        
        ]);
    }

    public function edit(Stock $stock)
    {
                
        $view = View::make('admin.stock.index')
        ->with('stock', $stock);
        
        if(request()->ajax()) {
            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function show(Stock $stock)
    {
        $view = View::make('admin.stock.index')
        ->with('stock', $stock)
        ->with('stocks', $this->stock->where('active', 1)->get());   
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;

    }

    public function destroy(Stock $stock)
    {   
        $stock->active = 0;
        $stock->save();

        $view = View::make('admin.stock.index')
        ->with('stocks', $this->stock->where('active', 1)->get())
        ->with('stock', $this->stock)
        ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
        ]);
    }
    
}

