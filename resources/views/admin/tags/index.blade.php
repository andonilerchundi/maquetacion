@php
    $route="tags";
    $filters = ['created_at' => true, 'search' => true]; 
@endphp


@extends('admin.layout.table_form')
    

@section('table')
    @isset($tag)

        <table class="table table-sortable">
            <thead>
                <tr>
                    <th>Grupo</th>
                    <th>Clave</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($tags as $tag_element)
                    <tr>
                        
                        <td>
                            {{$tag_element->group}}
                        </td>
                        <td>
                            {{$tag_element->key}}
                        </td>
                        <td>
                            {{ Carbon\Carbon::parse($tag_element->created_at)->format('d-m-Y') }}
                        </td>



                        <td>
                            <div class="button-container">

                                <button class="edit" id="edit" data-url="{{route('tags_edit', ['group' => str_replace('/', '-' , $tag_element->group) , 'key' => $tag_element->key])}}">
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
            @include('admin.layout.partials.table_pagination_desktop', ['items' => $tags])
        @endif
        @if($agent->isMobile())
            @include('admin.layout.partials.table_pagination_mobile', ['items' => $tags])
        @endif
       
    @endif

@endsection

@section('form')

    @isset($tag)
        <form class="formulario admin-form" action="{{route("tags_store")}}">

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

            <div class="input-container">
                <input type="hidden" name="group" value="{{$tag->group}}">
                <input type="hidden" name="key" value="{{$tag->key}}">
            </div>

            <div class="tab-panel tab-active" data-tab="contenido">

                <div class="one-columns">

                    <div class="form-group">
                        
                        <div class="label-container">
                            <label for="name">Traducción para la clave {{$tag->key}} del grupo {{$tag->group}}:</label>
                        </div>
                        
                    </div>
                    
                
                </div>

                @component('admin.layout.partials.locale', ['tab' => 'contenido'])

                    @foreach ($localizations as $localization)
                        <div class="tab-panel-language {{ $loop->first ? 'language-active':'' }}" data-tab="contenido" data-localetab="{{$localization->alias}}">
                            <div class="one-column" >

                                <div class="form-group">
                                    
                                    <div class="label-container">
                                        <label for="tag">Traducción:</label>
                                    </div>

                                    <div class="input-container">
                                        <textarea type="text" name="tag[value.{{$localization->alias}}]" value="{{isset($tag["value.$localization->alias"]) ? $tag["value.$localization->alias"] : ''}}" ></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                    
                @endcomponent

                <div class="import-content">

                    <button id="import-tags" data-url="{{route('tags_import')}}">

                        Importar TAG
                        
                        <svg viewBox="0 0 24 24">
                            <path fill="currentColor" d="M14,12L10,8V11H2V13H10V16M20,18V6C20,4.89 19.1,4 18,4H6A2,2 0 0,0 4,6V9H6V6H18V18H6V15H4V18A2,2 0 0,0 6,20H18A2,2 0 0,0 20,18Z" />
                        </svg>
                    </button>

                </div>

               

            </div>
 
        </form>
    @endif
@endsection

       