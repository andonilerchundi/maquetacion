@php
    $route="faqs";
    $filters = ['category' => $faqs_categories, 'created_at' => true, 'search' => true]; 
@endphp


@extends('admin.layout.table_form')
    

@section('table')
    @isset($faqs)

        <table class="table table-sortable">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($faqs as $faq_element)
                    <tr>
                        
                        <td>
                            {{$faq_element->name}}
                        </td>
                        
                        <td>
                            {{$faq_element->category->name}}
                        </td>
                        <td>
                            {{ Carbon\Carbon::parse($faq_element->created_at)->format('d-m-Y') }}
                        </td>



                        <td>
                            <div class="button-container">

                                <button class="edit" id="edit" data-url="{{route('faqs_show', ['faq' => $faq_element->id ])}}"> 
                                    <svg  viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                    </svg>
                                </button>

                                <button class="remove" data-url="{{route('faqs_destroy', ['faq' => $faq_element->id ])}}">
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
            @include('admin.layout.partials.table_pagination_desktop', ['items' => $faqs])
        @endif
        @if($agent->isMobile())
            @include('admin.layout.partials.table_pagination_mobile', ['items' => $faqs])
        @endif
       
    @endif

@endsection

@section('form')

    @isset($faq)
        <form class="formulario admin-form" action="{{route("faqs_store")}}">

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

                </div>

                <div class="right-top-bar">
   
                    <button id="send">
                        <svg  viewBox="0 0 24 24">
                            <path fill="currentColor" d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z" />
                        </svg>
                    </button>
                
                    <button id="refresh-form" data-url="{{route('faqs_create')}}"> 
                        <svg  viewBox="0 0 24 24">
                            <path fill="currentColor" d="M19.36,2.72L20.78,4.14L15.06,9.85C16.13,11.39 16.28,13.24 15.38,14.44L9.06,8.12C10.26,7.22 12.11,7.37 13.65,8.44L19.36,2.72M5.93,17.57C3.92,15.56 2.69,13.16 2.35,10.92L7.23,8.83L14.67,16.27L12.58,21.15C10.34,20.81 7.94,19.58 5.93,17.57Z" />
                        </svg>
                    </button>

                </div>
               
            </div>

            <div class="input-container">
                <input type="hidden" name="id" value="{{isset($faq->id) ? $faq->id : ''}}">
            </div>

            <div class="tab-panel tab-active" data-tab="contenido">

                <div class="two-columns">

                    <div class="form-group">
                        
                        <div class="label-container">
                            <label for="name">Nombre:</label>
                        </div>

                        <div class="input-container">
                            <input name="name" type="text" value="{{isset($faq->name) ? $faq->name : ''}}" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="label-container">
                            <label for="category_id" class="label-highlight">
                                Categoría:
                            </label>
                        </div>
                        <div class="input-container">
                            <div class="category_id">
                                
                                <select name="category_id"> 
                                    <option> </option>

                                    @foreach($faqs_categories as $faq_category_element)
                                        <option value="{{$faq_category_element->id}}" {{$faq_category_element->id == $faq->category_id ? 'selected' : ''}}> {{$faq_category_element->name}} </option>
                                    @endforeach
                                    
                                </select>
                            </div>
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
                                        <input type="text" name="locale[title.{{$localization->alias}}]" value="{{isset($locale["title.$localization->alias"]) ? $locale["title.$localization->alias"] : ''}}" class="input-highlight">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="label-container">
                                        <label for="respuesta">Respuesta:</label>
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
                            <div class="one-columns">

                                @include('admin.layout.partials.upload', [
                                    'type' => 'image', 
                                    'content' => 'featured', 
                                    'alias' => $localization->alias,
                                    'files' => $faq->images_featured_preview,
                                ])

                            </div>
                        </div>

                        
                    @endforeach
                    
                @endcomponent
            
            </div>
 
        </form>
    @endif
@endsection

       