<div class="main-filter">

    <div class="filter" id="filter">
        
        <form class="filter-form" id="filter-form" action="{{route($route.'_filter')}}" autocomplete="off">             

            {{ csrf_field() }}


            @foreach ($filters as $key => $items)

               
            
                @if($key == 'parent')
                   
                       
                    <div class="label-container">
                        <label for="parent" class="label">Filtrar por grupo</label>
                    </div>
                    <div class="input-container">
                        <select name="parent" data-placeholder="Seleccione una categoría" class="input">
                            <option value="all">Todos</option>
                            @foreach($items as $item)
                                <option value="{{$item}}"}}>{{$item}}</option>
                            @endforeach
                        </select>    
                    </div>
                       
                        
                @endif

                @if($key == 'category')
                    
                       
                    <div class="label-container">
                        <label for="category_id" class="label">Filtrar por categoría</label>
                    </div>
                    <div class="input-container">
                        <select name="category_id" data-placeholder="Seleccione una categoría" class="input">
                            <option value="all"}}>Todas</option>
                            @foreach($items as $item)
                                <option value="{{$item->id}}"}}>{{ $item->name }}</option>
                            @endforeach
                        </select>    
                    </div>
                        
                @endif
                @if($key == 'oz')
                    
                    <div class="label-container">
                        <label for="oz_id" class="label">Filtrar por OZ</label>
                    </div>
                    <div class="input-container">
                        <select name="oz_id" data-placeholder="Seleccione OZ" class="input">
                            <option value="all">Todas</option>
                            @foreach($items as $item)
                                <option value="{{$item->id}}">{{ $item->oz }}</option>
                            @endforeach
                        </select>    
                    </div>
                    
                @endif
                
                @if($key == 'brand')
                    
                       
                    <div class="label-container">
                        <label for="brand_id" class="label">Filtrar por Marca</label>
                    </div>
                    <div class="input-container">
                        <select name="brand_id" data-placeholder="Seleccione Marca" class="input">
                            <option value="all">Todas</option>
                            @foreach($items as $item)
                                <option value="{{$item->id}}">{{ $item->brand }}</option>
                            @endforeach
                        </select>    
                    </div>
                    
                @endif

               
                @if($agent->isMobile())

                    @if ($key == 'created_at')

                        <div class="label-container">
                            <label for="date" class="label">Fechas</label>
                        </div>    
                        <div id="date-container-filter">
                            
                            <div class="input-container">
                                <input type="date" name="created_at_from" class="date-input">
                            </div>
                            <p>-</p> 
                            <div class="input-container">
                                <input type="date" name="created_at_since" class="date-input">
                            </div>
                        </div>
                    @endif
                @endif

                @if($agent->isDesktop())

                    @if ($key == 'created_at')

                    <div class="label-container">
                        <label for="date" class="label">Fechas</label>
                    </div>    
                   
                        
                    <div class="input-container">
                        <input type="date" name="created_at_from" class="date-input">
                    </div>
                       
                    <div class="input-container">
                        <input type="date" name="created_at_since" class="date-input">
                    </div>
                    
                @endif


                @endif
                


                @if($key == 'search')
                   
                       
                    <div class="label-container">
                        <label for="search" class="label">Buscar palabra</label>
                    </div>
                    <div class="input-container">
                        <input type="text" name="search" class="input" value="">
                    </div>
                        
                    
                @endif

            @endforeach
                 
        </form>

        <button id="apply-filter">
            Filtrar
        </button>   
    </div>

    <div class="filter-button" id="filter-button">
        <svg  viewBox="0 0 24 24">
            <path fill="currentColor" d="M11 11L16.76 3.62A1 1 0 0 0 16.59 2.22A1 1 0 0 0 16 2H2A1 1 0 0 0 1.38 2.22A1 1 0 0 0 1.21 3.62L7 11V16.87A1 1 0 0 0 7.29 17.7L9.29 19.7A1 1 0 0 0 10.7 19.7A1 1 0 0 0 11 18.87V11M13 16L18 21L23 16Z" />
        </svg>

    </div>
    


</div>