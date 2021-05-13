<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientRequest;
use App\Models\DB\Client;

class ClientController extends Controller
{
    protected $client;

    function __construct(Client $client)
    {
        // $this->middleware('auth');  
        $this->client = $client;
    }

    public function index()
    {

        $view = View::make('admin.client.index')
                ->with('client', $this->client)
                ->with('customers', $this->client->where('active', 1)->get());

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

        $view = View::make('admin.client.index')
        ->with('client', $this->client)
        ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }

    public function store(ClientRequest $request)
    {            
        $client = $this->client->updateOrCreate([
            'id' => request('id')],[
            'name' => request('name'),
            'email' => request('email'),
            'telefono' => request('telefono'),
            'address'=> request('address'),
            'country_id'=>request('country_id'),
            'cp'=> request('cp'),
            'ciudad'=> request('ciudad'),
            'nif' => request('nif'),
            'active' => 1,
          
        ]);

        $view = View::make('admin.client.index')
        ->with('customers', $this->client->where('active', 1)->get())
        ->with('client', $client)
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'id' => $client->id,
        ]);
    }

    public function show(Client $client)
    {
        $view = View::make('admin.client.index')
        ->with('client', $client)
        ->with('customers', $this->client->where('active', 1)->get());   
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function destroy(Client $client)
    {
        $client->active = 0;
        $client->save();

        // $client->delete();

        $view = View::make('admin.client.index')
            ->with('client', $this->client)
            ->with('customers', $this->client->where('active', 1)->get())
            ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);
    }
}

    