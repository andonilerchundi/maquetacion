@extends('front.master')

@section('content')
    
    <div class="gloves">
        @foreach ($gloves as $glove)
            <div class="image-grid">

                <li class="show-single-product" data-url="{{route('front_glove', ['slug' => $glove->seo->slug])}}">
                    
                    <div class="single-product-image-content">
                        @isset($glove->image_featured_desktop->path)
                            <div class="glove-image-single">
                                <img src="{{Storage::url($glove->image_featured_desktop->path)}}" alt="{{$glove->image_featured_desktop->alt}}" title="{{$glove->image_featured_desktop->title}}" />
                            </div>
                        @endif
                    </div>
    
                    <div class="product-name">
                
                        <h2>{!!isset ($glove->name) ? $glove->name : "" !!}</h2> 
                    </div>

                    <div class="price">

                        {{isset ($glove->product->total_price) ? $glove->product->total_price : "" }} € 

                    </div>

                </li>

            </div>

        @endforeach
        
    </div>

@endsection