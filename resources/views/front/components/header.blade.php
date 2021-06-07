<header class="main-header">

    <div class="header-container">

        <div class="logo-container">

            @isset($logo->path)
                <a href="/"><img src="{{Storage::url($logo->path)}}" alt="{{$logo->alt}}" title="{{$logo->title}}"></a>
            @endisset

        </div>

        <div class="header-menu">

            <div class="contact">
                
                <h3>Contato</h3>

                

            </div>
            <div class="prueba">

                <h3>cosas</h3>

            </div>

            <div class="prueba">

                <h3>mas cosas</h3>

            </div>


        </div>


    </div>


</header>