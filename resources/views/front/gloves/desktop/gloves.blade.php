@extends('front.master')

@section('content')
    <div class="content-product">
        <div class="filter-content">
            <div class="button-filter">

                <svg  viewBox="0 0 24 24">
                    <path fill="currentColor" d="M14,12V19.88C14.04,20.18 13.94,20.5 13.71,20.71C13.32,21.1 12.69,21.1 12.3,20.71L10.29,18.7C10.06,18.47 9.96,18.16 10,17.87V12H9.97L4.21,4.62C3.87,4.19 3.95,3.56 4.38,3.22C4.57,3.08 4.78,3 5,3V3H19V3C19.22,3 19.43,3.08 19.62,3.22C20.05,3.56 20.13,4.19 19.79,4.62L14.03,12H14Z" />
                </svg>
                <p>FILTROS</p>

                <svg  viewBox="0 0 24 24">
                    <path fill="currentColor" d="M7,10L12,15L17,10H7Z" />
                </svg>

            </div>
            <div class="filter-menu">
                hola



            </div>



        </div>
        <div class="gloves">
            @foreach ($gloves as $glove)
                <div class="image-grid">
    
                    <li class="show-single-product" data-url="{{route('front_glove', ['slug' => $glove->seo->slug])}}">
                        {{Debugbar::info($glove->seo->slug)}}
                        <div class="single-product-image-content">
                            @isset($glove->image_featured_desktop->path)
                                <div class="glove-image-single">
                                    <img src="{{Storage::url($glove->image_featured_desktop->path)}}" alt="{{$glove->image_featured_desktop->alt}}" title="{{$glove->image_featured_desktop->title}}" />
                                </div>
                            @endif
                        </div>
                        <div class="product-especification">
                            <div class="brand">
    
                                <h4>{{isset ($glove->brand_name) ? $glove->brand_name : "" }}</h4>
        
                            </div>
            
                            <div class="product-name">
                        
                                <h4>{!!isset ($glove->name) ? $glove->name : "" !!}</h2> 

                            </div>
        
                            <div class="price">
        
                                {{isset ($glove->product->total_price) ? $glove->product->total_price : "" }} € 
        
                            </div>

                        </div>

                    </li>
    
                </div>
    
            @endforeach
            
        </div>
        


    </div>
    
    

@endsection