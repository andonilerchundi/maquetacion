
@extends('admin.layout.table_form')
    
@section('table')

    <table>
        
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Stock</th>
            <th></th>
        </tr>
        
        @foreach($stocks as $stock_element)
            <tr>
                
                <td>
                    {{$stock_element->id}}
                </td>
                
                <td>
                    {{$stock_element->name}}
                </td>
                
                <td>
                    {{$stock_element->stock}}
                </td>

                <td>
                    <div class="button-container">

                        <button class="edit" id="edit" data-url="{{route('stock_show', ['stock' => $stock_element->id ])}}"> 
                            <svg  viewBox="0 0 24 24">
                            <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                            </svg>
                        </button>

                        <button class="remove" data-url="{{route('stock_destroy', ['stock' => $stock_element->id ])}}">
                            <svg  viewBox="0 0 24 24">
                            <path fill="currentColor" d="M20 6.91L17.09 4L12 9.09L6.91 4L4 6.91L9.09 12L4 17.09L6.91 20L12 14.91L17.09 20L20 17.09L14.91 12L20 6.91Z" />
                            </svg>
                        </button>

                    </div>
                </td>
                
            </tr>
        @endforeach
        
    </table>

@endsection

@section('form')

    <form class="formulario admin-form" action="{{route("stock_store")}}">

        {{ csrf_field() }}


        <div class="form-group">
            <input type="hidden" name="id" value="{{isset($stock->id) ? $stock->id : ''}}">

            
            <div class="label-container">
                <label for="name">Nombre:</label>
            </div>

            <div class="input-container">
                <input name="name" type="text" value="{{isset($stock->name) ? $stock->name : ''}}" >
            </div>

            <div class="label-container">
                <label for="stock">Stock:</label>
            </div>

            <div class="input-container">
                <input name="stock" type="number" value="{{isset($stock->stock) ? $stock->stock : ''}}" >
            </div>
        </div>

        <div class="button">
            <button id="send"> Enviar </button>
        </div>

        <div class="button">
            <button id="reload" > Reload </button>
        </div>
        
    </form>

@endsection
    