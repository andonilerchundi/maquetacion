
<div class="glove" >
    <div class="glove-color">

        <input type="color" value="{!!isset ($glove->color) ? $glove->color : "" !!}">
       
    </div>
    <div class="product-content">
        <div class="product-image-content">

            @isset($glove->image_featured_desktop->path)
                <div class="glove-description-image">
                    <img src="{{Storage::url($glove->image_featured_desktop->path)}}" alt="{{$glove->image_featured_desktop->alt}}" title="{{$glove->image_featured_desktop->title}}" />
                </div>
            @endif

        </div>
        <div class="product-info-content">
    
            <div class="product-title">
    
                <h2>{{isset($glove->seo->title) ? $glove->seo->title : ""}}</h2>
    
            </div>
            <div class="product-description">
    
                {!!isset($glove->locale['description']) ? $glove->locale['description'] : "" !!}
            
            </div>
         
            <div class="product-brand-head">
                

               <h2>{!!isset ($glove->brand_name) ? $glove->brand_name : "" !!}</h2> 



            </div>

            <div class="product-size">
                <h3>OZ:</h3>
                
                <div class="size-oz">
                    @foreach ($glove->glove_oz as $gloves_oz)
                        <div class="oz-options">

                            <label for="oz">{{$gloves_oz->oz->oz}}</label>
                            <input type="checkbox" @foreach ($glove->glove_oz as $gloves_oz)
                            {{$gloves_oz->oz->oz}}
                            @endforeach  >

                        </div>
                        
                    
                    @endforeach


                </div>
                
            </div>


            <div class="product-price">

                {{isset ($glove->product->total_price) ? $glove->product->total_price : "" }} € 
            
            </div>
            
            <button class="cart-button">

                <p>Añadir al carrito</p>

            </button>
    
    
    
        </div>



    </div>
   




























</div>
