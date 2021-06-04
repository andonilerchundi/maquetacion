@php
    $route = 'menus';
@endphp

@extends('admin.layout.table_form')

@section('table')

    @isset($menus)

       


        <table class="table table-sortable">
            <thead>
                <tr>
                    <th>Nombre</th>
                    
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach($menus as $menu_element)
                    <tr>
                        
                        <td>
                            {{$menu_element->name}}
                        </td>
                        
                       
                        <td>
                            <div class="button-container">

                                <button class="edit" id="edit" data-url="{{route('menus_show', ['menu' => $menu_element->id ])}}"> 
                                    <svg  viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                    </svg>
                                </button>

                                <button class="remove" data-url="{{route('menus_destroy', ['menu' => $menu_element->id ])}}">
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
            @include('admin.layout.partials.table_pagination_desktop', ['items' => $menus])
        @endif

        @if($agent->isMobile())
            @include('admin.layout.partials.table_pagination_mobile', ['items' => $menus])
        @endif
    @endisset

@endsection

@section('form')

    @isset($menu)

        <div class="form-container">
            <form class="admin-form" id="menus-form" action="{{route("menus_store")}}" autocomplete="off">

                {{ csrf_field() }}

                <input autocomplete="false" name="hidden" type="text" style="display:none;">
                <input type="hidden" name="id" value="{{isset($menu->id) ? $menu->id : ''}}">


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
                    
                        <button id="refresh-form" data-url="{{route('menus_create')}}"> 
                            <svg  viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19.36,2.72L20.78,4.14L15.06,9.85C16.13,11.39 16.28,13.24 15.38,14.44L9.06,8.12C10.26,7.22 12.11,7.37 13.65,8.44L19.36,2.72M5.93,17.57C3.92,15.56 2.69,13.16 2.35,10.92L7.23,8.83L14.67,16.27L12.58,21.15C10.34,20.81 7.94,19.58 5.93,17.57Z" />
                            </svg>
                        </button>
    
                    </div>
                   
                </div>
                
             
                
                <div class="tab-panel tab-active" data-tab="contenido">
                    <div class="one-column">
                        <div class="form-group">
                            <div class="form-label">
                                <label for="name" class="label-highlight">Nombre</label>
                            </div>
                            <div class="form-input">
                                <input type="text" name="name" value="{{isset($menu->name) ? $menu->name : ''}}"  class="input-highlight"  />
                            </div>
                        </div>
                    </div>
                </div>

            </form>

            @isset($menu->name)
                <div id="menu-item-form-container">
                    @include('admin.menu_items.index', ['menu' => $menu])
                </div>
            @endisset

        </div>

    @endisset

@endsection