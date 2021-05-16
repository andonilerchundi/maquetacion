@php
    // $route="sliders";
    $filters = ['created_at' => true, 'search' => true]; 
@endphp


@extends('admin.layout.table_form')
    

@section('table')
    @isset($sliders)

        <table class="table table-sortable">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Alias</th>
                    <th>Visible</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($sliders as $slider_element)
                    <tr>
                        
                        <td>
                            {{$slider_element->name}}
                        </td>
                        
                        <td>
                            {{$slider_element->entity}}
                        </td>

                        <td>
                            {{$slider_element->visible}}
                        </td>
                        <td>
                            {{ Carbon\Carbon::parse($slider_element->created_at)->format('d-m-Y') }}
                        </td>



                        <td>
                            <div class="button-container">

                                <button class="edit" id="edit" data-url="{{route('sliders_show', ['slider' => $slider_element->id ])}}"> 
                                    <svg  viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                    </svg>
                                </button>

                                <button class="remove" data-url="{{route('sliders_destroy', ['slider' => $slider_element->id ])}}">
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
            @include('admin.layout.partials.table_pagination_desktop', ['items' => $sliders])
        @endif
        @if($agent->isMobile())
            @include('admin.layout.partials.table_pagination_mobile', ['items' => $sliders])
        @endif
    @endif

@endsection

@section('form')

    @isset($slider)
        <form class="formulario admin-form" action="{{route("sliders_store")}}">

            {{ csrf_field() }}
            <div class="column-container">
                <div class="column">

                    <div class="input-container">
                        <input type="hidden" name="id" value="{{isset($slider->id) ? $slider->id : ''}}">
                    </div>
                    

                    <div class="form-group">
                        
                        <div class="label-container">
                            <label for="Nombre">Nombre:</label>
                        </div>

                        <div class="input-container">
                            <input name="name" type="text" value="{{isset($slider->name) ? $slider->name : ''}}" >
                        </div>
                    </div>

                    
                    
                </div>

                <div class="column">
                    <div class="form-group">
                        <div class="label-container">
                            <label for="entity" class="label-highlight">
                                Alias:
                            </label>
                        </div>
                        <div class="input-container">
                            <div class="entity">
                                
                                <input name="entity" type="text" value="{{isset($slider->entity) ? $slider->entity : ''}}" >

                            </div>
                        </div>
                    </div> 

                    <div class="form-group">
                        <div class="label-container">
                            <label for="visible" class="label-highlight">
                                Visible:
                            </label>
                        </div>

                        @if($agent->isDesktop())
                            <div class="input-container">
                                <input type="checkbox" name="visible" id="visible" class="checkbox" value="{{$slider->visible == 1 ? 'true' : 'false'}}" {{$slider->visible == 1 ? 'checked' : '' }}>
                            </div>
                        @endif

                        @if($agent->isMobile())
                            <div class="input-container">
                                <div class="visible">
                                    <label class="switch">
                                        <input type="checkbox" name="visible" id="visible" class="checkbox" value="{{$slider->visible == 1 ? 'true' : 'false'}}" {{$slider->visible == 1 ? 'checked' : '' }}>
                                        <span class="toggle-thumb">
                                            <svg class="check">
                                                <path fill="currentColor" d="M9,20.42L2.79,14.21L5.62,11.38L9,14.77L18.88,4.88L21.71,7.71L9,20.42Z" />
                                            </svg>

                                            <svg class="cross" >
                                                <path fill="currentColor" d="M20 6.91L17.09 4L12 9.09L6.91 4L4 6.91L9.09 12L4 17.09L6.91 20L12 14.91L17.09 20L20 17.09L14.91 12L20 6.91Z" />
                                            </svg>
                                        </span>
                                    </label> 
                                </div>
                            </div>
                        @endif
                    </div> 

                </div>
            
            </div>
            
            <div class="button-form-container">
                <div class="button">
                    <button id="send">
                        <svg  viewBox="0 0 24 24">
                            <path fill="currentColor" d="M2,21L23,12L2,3V10L17,12L2,14V21Z" />
                        </svg>
                    </button>
                </div>

                <div class="button" >
                    <button id="refresh-form" data-url="{{route('sliders_create')}}"> 
                        <svg  viewBox="0 0 24 24">
                            <path fill="currentColor" d="M17.65,6.35C16.2,4.9 14.21,4 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20C15.73,20 18.84,17.45 19.73,14H17.65C16.83,16.33 14.61,18 12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6C13.66,6 15.14,6.69 16.22,7.78L13,11H20V4L17.65,6.35Z" />
                        </svg>
                    </button>
                </div>
                
            </div>
           
        </form>
    @endif
@endsection