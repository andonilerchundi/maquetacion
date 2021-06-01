<div class="glove">
    

    <div class="two-columns">

        <div class="glove-image-content">

            @foreach ($glove->image_grid_desktop as $collection)
                <div class="glove-image-collection">
                    <img src="{{Storage::url($collection->path)}}" alt="{{$collection->alt}}" title="{{$collection->title}}" />
                </div>
            @endforeach

        </div>

        <div class="glove-description-content">
            <div class="title-price">
                <div class="glove-title">
                    <h2>{{isset($glove->seo->title) ? $glove->seo->title : ""}}</h2>
                </div>
                <div class="glove-price">

                    {{isset ($glove->product->total_price) ? $glove->product->total_price : "" }} € 

                </div>

            </div>

            <div class="glove-color">

                <h3>Color:</h3>

                <input type="color" value="{!!isset ($glove->color) ? $glove->color : "" !!}">
               
            </div>

            <div class="glove-oz">

                <h3>OZ:</h3>

                @foreach ($glove->glove_oz as $gloves_oz)

                    <label for="oz">{{$gloves_oz->oz->oz}}</label>
                    <input type="checkbox" @foreach ($glove->glove_oz as $gloves_oz)
                    {{$gloves_oz->oz->oz}}
                    @endforeach  >

                
                   
                    
                @endforeach

                
                
                
            </div>

            <div class="add-cart">

                <div class="cart-button">

                    Añadir a bolsa
                    <svg  viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12,13A5,5 0 0,1 7,8H9A3,3 0 0,0 12,11A3,3 0 0,0 15,8H17A5,5 0 0,1 12,13M12,3A3,3 0 0,1 15,6H9A3,3 0 0,1 12,3M19,6H17A5,5 0 0,0 12,1A5,5 0 0,0 7,6H5C3.89,6 3,6.89 3,8V20A2,2 0 0,0 5,22H19A2,2 0 0,0 21,20V8C21,6.89 20.1,6 19,6Z" />
                    </svg>

                </div>

            </div>
            


            <div class="glove-description-text">
                {!!isset($glove->locale['description']) ? $glove->locale['description'] : "" !!}
            </div>

        </div>


    </div>

    
    
</div>
