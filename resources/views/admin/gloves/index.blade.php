@php
    $route="gloves";
    $filters = ['oz' => $oz,'brand'=>$brand, 'created_at' => true, 'search' => true]; 
@endphp


@extends('admin.layout.table_form')
    

@section('table')
    @isset($glove)

        <table class="table table-sortable">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Precio Total</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach($gloves as $glove_element)
                    <tr>
                        
                        <td>
                            {{$glove_element->name}}
                        </td>
                        
                        <td>
                            {{$glove_element->product->total_price}}
                        </td>

                        <td>
                            {{ Carbon\Carbon::parse($glove_element->created_at)->format('d-m-Y') }}
                        </td>

                        <td>
                            <div class="button-container">

                                <button class="edit" id="edit" data-url="{{route('gloves_show', ['glove' => $glove_element->id ])}}"> 
                                    <svg  viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                    </svg>
                                </button>

                                <button class="remove" data-url="{{route('gloves_destroy', ['glove' => $glove_element->id ])}}">
                                    <svg  viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M20 6.91L17.09 4L12 9.09L6.91 4L4 6.91L9.09 12L4 17.09L6.91 20L12 14.91L17.09 20L20 17.09L14.91 12L20 6.91Z" />
                                    </svg>
                                </button>

                            </div>
                        </td>
                    
                    </tr>
                    
                @endforeach

                
            </tbody>
            
        </table>
        
        @if($agent->isDesktop())
            @include('admin.layout.partials.table_pagination_desktop', ['items' => $gloves])
        @endif

        @if($agent->isMobile())
            @include('admin.layout.partials.table_pagination_mobile', ['items' => $gloves])
        @endif
       
    @endif

@endsection

@section('form')

    @isset($glove)
        <form class="formulario admin-form" action="{{route("gloves_store")}}">

            {{ csrf_field() }}


            <div class="top-bar-form">

                <div class="left-top-bar">

                    <div class="tab-items tab-active" data-tab="contenido">
                        <svg  viewBox="0 0 24 24">
                            <path fill="currentColor" d="M19,20H5V4H7V7H17V4H19M12,2A1,1 0 0,1 13,3A1,1 0 0,1 12,4A1,1 0 0,1 11,3A1,1 0 0,1 12,2M19,2H14.82C14.4,0.84 13.3,0 12,0C10.7,0 9.6,0.84 9.18,2H5A2,2 0 0,0 3,4V20A2,2 0 0,0 5,22H19A2,2 0 0,0 21,20V4A2,2 0 0,0 19,2Z" />
                        </svg>
                    </div> 
                    <div class="tab-items" data-tab="imagen">
                        <svg  viewBox="0 0 24 24">
                            <path fill="currentColor" d="M8.5,13.5L11,16.5L14.5,12L19,18H5M21,19V5C21,3.89 20.1,3 19,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19Z" />
                        </svg>
                    </div>
                    <div class="tab-items" data-tab="seo">
                        <svg  viewBox="0 0 24 24">
                            <path fill="currentColor" d="M21.35,11.1H12.18V13.83H18.69C18.36,17.64 15.19,19.27 12.19,19.27C8.36,19.27 5,16.25 5,12C5,7.9 8.2,4.73 12.2,4.73C15.29,4.73 17.1,6.7 17.1,6.7L19,4.72C19,4.72 16.56,2 12.1,2C6.42,2 2.03,6.8 2.03,12C2.03,17.05 6.16,22 12.25,22C17.6,22 21.5,18.33 21.5,12.91C21.5,11.76 21.35,11.1 21.35,11.1V11.1Z" />
                        </svg>
                    </div>  
                    <div class="tab-items" data-tab="product">
                        <svg  viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12,13A5,5 0 0,1 7,8H9A3,3 0 0,0 12,11A3,3 0 0,0 15,8H17A5,5 0 0,1 12,13M12,3A3,3 0 0,1 15,6H9A3,3 0 0,1 12,3M19,6H17A5,5 0 0,0 12,1A5,5 0 0,0 7,6H5C3.89,6 3,6.89 3,8V20A2,2 0 0,0 5,22H19A2,2 0 0,0 21,20V8C21,6.89 20.1,6 19,6Z" />
                        </svg>
                    </div>  

                </div>

                <div class="right-top-bar">
   
                    <button id="send">
                        <svg  viewBox="0 0 24 24">
                            <path fill="currentColor" d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z" />
                        </svg>
                    </button>
                
                    <button id="refresh-form" data-url="{{route('gloves_create')}}"> 
                        <svg  viewBox="0 0 24 24">
                            <path fill="currentColor" d="M19.36,2.72L20.78,4.14L15.06,9.85C16.13,11.39 16.28,13.24 15.38,14.44L9.06,8.12C10.26,7.22 12.11,7.37 13.65,8.44L19.36,2.72M5.93,17.57C3.92,15.56 2.69,13.16 2.35,10.92L7.23,8.83L14.67,16.27L12.58,21.15C10.34,20.81 7.94,19.58 5.93,17.57Z" />
                        </svg>
                    </button>

                </div>
               
            </div>

            <div class="input-container">
                <input type="hidden" name="id" value="{{isset($glove->id) ? $glove->id : ''}}">
            </div>

            <div class="tab-panel tab-active" data-tab="contenido">

                <div class="one-columns">

                    <div class="form-group">
                        
                        <div class="label-container">
                            <label for="name">Nombre:</label>
                        </div>

                        <div class="input-container">
                            <input name="name" type="text" value="{{isset($glove->name) ? $glove->name : ''}}" >
                        </div>
                    </div>
                    
                   
                </div>
                <div class="two_column glove-style">

                    <div class="form-group oz-content">
                        <div class="label-container">
                            <label for="oz_id" class="label-highlight">
                                OZ:
                            </label>
                        </div>
                        <div class="input-container">
                            <div class="oz_id">

                              

                                @foreach($oz as $oz_element)

                                    <div class="checkbox-oz">
                                        <label for="oz">{{$oz_element->oz}}</label>
                                        <input type="checkbox" name="oz[{{$oz_element->oz}}]" value="{{$oz_element->id}}" 
                                    

                                        @foreach($glove->glove_oz as $gloves_oz)

                                            {{$oz_element->id == $gloves_oz->oz->id ? 'checked': ''}}
                                        

                                        @endforeach
                                     ></div>
                                @endforeach
                                    
                            </div>
                        </div>
                    </div> 

                    <div class="one-column color-brand">
                        <div class="form-group">
                            
                            <div class="label-container">
                                <label>Color:</label>
                            </div>
    
                            <div class="input-container color">
                                <input type="color" name="color" value="{{isset($glove->color) ? $glove->color : ''}}" >
                            </div>
                        </div>
                        <div class="form-group">
                            
                            <div class="label-container">
                                <label>Marca:</label>
                            </div>
    
                            <select name="brand_id" class="brand-input"> 
                                <option> </option>
    
                                @foreach($brand as $brand_element)
                                    <option value="{{$brand_element->name}}" {{$brand_element->name == $glove->brand_id ? 'selected' : ''}}> {{$brand_element->name}} </option>
                                @endforeach
                                
                            </select>
                        </div>
    
                    </div>

                </div>

                @component('admin.layout.partials.locale', ['tab' => 'contenido'])

                    @foreach ($localizations as $localization)
                        <div class="tab-panel-language {{ $loop->first ? 'language-active':'' }}" data-tab="contenido" data-localetab="{{$localization->alias}}">
                            <div class="one-column" >

                                <div class="form-group">
                                    
                                    <div class="label-container">
                                        <label>Titulo:</label>
                                    </div>

                                    <div class="input-container">
                                        <input type="text" name="seo[title.{{$localization->alias}}]" value="{{isset($seo["title.$localization->alias"]) ? $seo["title.$localization->alias"] : ''}}" class="input-highlight">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="label-container">
                                        <label for="respuesta">Descripción del producto:</label>
                                    </div>
                        
                                    <div class="input-container">
                                        <textarea class="ckeditor input-highlight" name="locale[description.{{$localization->alias}}]">{{isset($locale["description.$localization->alias"]) ? $locale["description.$localization->alias"] : ''}}</textarea>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                @endcomponent
    
            </div>

            <div class="tab-panel" data-tab="imagen">

                @component('admin.layout.partials.locale', ['tab' => 'imagen'])
                    
                    @foreach ($localizations as $localization)

                        <div class="tab-panel-language {{ $loop->first ? 'language-active':'' }}" data-tab="imagen" data-localetab="{{$localization->alias}}">
                            <div class="two-columns">

                                <div class="form-group">
                                    @include('admin.layout.partials.upload', [
                                        'entity' => 'gloves',
                                        'type' => 'single', 
                                        'content' => 'featured', 
                                        'alias' => $localization->alias,
                                        'files' => $glove->images_featured_preview,
                                    ])

                                </div>

                                <div class="form-group">

                                    @include('admin.layout.partials.upload', [
                                        'entity' => 'gloves',
                                        'type' => 'collection', 
                                        'content' => 'grid', 
                                        'alias' => $localization->alias,
                                        'files' => $glove->images_grid_preview,
                                    ])

                                </div>

                            </div>
                        </div>

                    @endforeach
                    
                @endcomponent
            
            </div>

            <div class="tab-panel" data-tab="seo">

                @component('admin.layout.partials.locale', ['tab' => 'seo'])
                    
                    @foreach ($localizations as $localization)

                        <div class="tab-panel-language {{ $loop->first ? 'language-active':'' }}" data-tab="seo" data-localetab="{{$localization->alias}}">
                            <div class="one-columns">

                                <div class="form-group">
                                    
                                    <div class="label-container">
                                        <label>Keywords:</label>
                                    </div>

                                    <div class="input-container">
                                        <input type="text" name="seo[keywords.{{$localization->alias}}]" value="{{isset($seo["keywords.$localization->alias"]) ? $seo["keywords.$localization->alias"] : ''}}" class="input-highlight">
                                    </div>
                                </div>
                                <div class="form-group">
                                    
                                    <div class="label-container">
                                        <label>Descripción:</label>
                                    </div>

                                    <div class="input-container">
                                        <textarea type="text" name="seo[description.{{$localization->alias}}]" value="{{isset($seo["description.$localization->alias"]) ? $seo["description.$localization->alias"] : ''}}" class="input-highlight">{{isset($seo["description.$localization->alias"]) ? $seo["description.$localization->alias"] : ''}}</textarea>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                    @endforeach
                    
                @endcomponent
            
            </div>

            <div class="tab-panel" data-tab="product">

                <div class="three-columns">

                    <div class="form-group">
                        
                        <div class="label-container">
                            <label>Base Imponible:</label>
                        </div>

                        <div class="input-container">
                            <input type="number" name="product[price]" value="{{isset($product->price) ? $product->price : ''}}" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        
                        <div class="label-container">
                            <label>IVA:</label>
                        </div>

                        <div class="input-container">
                            <select name="product[iva]" > 
                                <option> </option>

                                @foreach($iva as $iva_element)
                                    <option value="{{$iva_element->iva}}" @isset($glove->product->iva) {{$iva_element->iva == $glove->product->iva ? 'selected' : ''}} @endisset> {{$iva_element->name}} </option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        
                        <div class="label-container">
                            <label>Precio Final:</label>
                        </div>

                        <div class="input-container">
                            <input type="number" name="product[total_price]" value="{{isset($product->total_price) ? $product->total_price : ''}}" >
                        </div>
                    </div>

                </div>
               
            
            </div>
 
 
        </form>
    @endif
@endsection

       