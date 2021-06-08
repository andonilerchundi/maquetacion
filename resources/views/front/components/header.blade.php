<header class="main-header">

    <div class="header-container">

        <div class="logo-container">

            @isset($logo->path)
                <a href="/"><img src="{{Storage::url($logo->path)}}" alt="{{$logo->alt}}" title="{{$logo->title}}"></a>
            @endisset

        </div>

       


    </div>


</header>