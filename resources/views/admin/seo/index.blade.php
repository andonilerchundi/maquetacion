@php
    $route="seo";
@endphp


@extends('admin.layout.table_form')
    

@section('table')

    @isset($seos)

        <table class="table table-sortable">
            <thead>
                <tr>
                    <th>Clave</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($seos as $seo_element)
                    <tr>
                        <td>
                            {{$seo_element->key}}
                        </td>
                        <td>
                            {{ Carbon\Carbon::parse($seo_element->created_at)->format('d-m-Y') }}
                        </td>

                        <td>
                            <div class="button-container">

                                <button class="edit" id="edit" data-url="{{route('seo_edit', ['key' => $seo_element->key])}}">
                                    <svg  viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                    </svg>
                                </button>

                            </div>
                        </td>
                    
                    </tr>
                    
                @endforeach

                
            </tbody>
            
        </table>
        @if($agent->isDesktop())
            @include('admin.layout.partials.table_pagination_desktop', ['items' => $seos])
        @endif
        @if($agent->isMobile())
            @include('admin.layout.partials.table_pagination_mobile', ['items' => $seos])
        @endif
       
    @endif

@endsection

@section('form')

    @isset($seo)
        <form class="formulario admin-form" action="{{route("seo_store")}}">

            {{ csrf_field() }}


            <div class="top-bar-form">

                <div class="left-top-bar">

                    <div class="tab-items tab-active" data-tab="contenido">
                        <svg  viewBox="0 0 24 24">
                            <path fill="currentColor" d="M19,20H5V4H7V7H17V4H19M12,2A1,1 0 0,1 13,3A1,1 0 0,1 12,4A1,1 0 0,1 11,3A1,1 0 0,1 12,2M19,2H14.82C14.4,0.84 13.3,0 12,0C10.7,0 9.6,0.84 9.18,2H5A2,2 0 0,0 3,4V20A2,2 0 0,0 5,22H19A2,2 0 0,0 21,20V4A2,2 0 0,0 19,2Z" />
                        </svg>
                    </div>

                </div>

                <div class="right-top-bar">
   
                    <button id="send">
                        <svg  viewBox="0 0 24 24">
                            <path fill="currentColor" d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z" />
                        </svg>
                    </button>
                
                </div>
               
            </div>

     
            <div class="tab-panel tab-active" data-tab="contenido">


                @component('admin.layout.partials.locale', ['tab' => 'contenido'])

                    @foreach ($localizations as $localization)

                        <div class="input-container">

                            <input type="hidden" name="seo[key.{{$localization->alias}}]" value="{{$seo["key.$localization->alias"]}}">
                            <input type="hidden" name="seo[group.{{$localization->alias}}]" value="{{$seo["group.$localization->alias"]}}">
                            <input type="hidden" name="seo[old_url.{{$localization->alias}}]" value="{{isset($seo["url.$localization->alias"]) ? $seo["url.$localization->alias"] : ''}}" class="input-highlight block-parameters"  data-regex="/\{.*?\}/g" > 
                        
                        </div>
        

                        <div class="tab-panel-language {{ $loop->first ? 'language-active':'' }}" data-tab="contenido" data-localetab="{{$localization->alias}}">
                           
                            <div class="one-column" >

                                <div class="form-group">
                                    
                                    <div class="label-container">
                                        <label for="seo[url.{{$localization->alias}}]" class="label-highlight">Url</label>
                                    </div>

                                    <div class="input-container">
                                        <input type="text" name="seo[url.{{$localization->alias}}]" value="{{isset($seo["url.$localization->alias"]) ? $seo["url.$localization->alias"] : ''}}" class="input-highlight block-parameters">
                                    </div>

                                </div>
                                <div class="form-group">
                                    
                                    <div class="label-container">
                                        <label for="seo[title.{{$localization->alias}}]" class="label-highlight">Título</label>
                                    </div>

                                    <div class="input-container">
                                        <input type="text" name="seo[title.{{$localization->alias}}]" value="{{isset($seo["title.$localization->alias"]) ? $seo["title.$localization->alias"] : ''}}" class="input-highlight">
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    
                                    <div class="label-container">
                                        <label for="seo[description.{{$localization->alias}}]" class="label-highlight">Descripción</label>
                                    </div>

                                    <div class="input-container">
                                        <input type="text" name="seo[description.{{$localization->alias}}]" value="{{isset($seo["description.$localization->alias"]) ? $seo["description.$localization->alias"] : ''}}" class="input-highlight">
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    
                                    <div class="label-container">
                                        <label for="name" class="label-highlight">Keywords</label>
                                    </div>

                                    <div class="input-container">
                                        <input type="text" name="seo[keywords.{{$localization->alias}}]" value="{{isset($seo["keywords.$localization->alias"]) ? $seo["keywords.$localization->alias"] : ''}}" class="input-highlight">
                                    </div>
                                    
                                </div>


                            </div>
                        </div>

                    @endforeach
                    
                @endcomponent
                
                
    
            </div>
 
        </form>
    @else



        <div class="two-column buttons-seo" >

            <div class="buttons-seo-content">

                <button id="import-seo" data-url="{{route('seo_import')}}">

                    Importar SEO
                    
                    
                </button>
                <button id="ping-google" data-url="{{route('ping_google')}}">

                    Robot de Google
                    
                    
                </button>
               
            </div>


        </div>
        <div class="one-column sitemap-button">

            <button id="create-sitemap" data-url="{{route('create_sitemap')}}">

                Crear Sitemap
                
               
            </button>
            <div class="form-input sitemap">
                <textarea id="sitemap" class="simple"></textarea>
            </div>

        </div>



    @endisset
@endsection

       