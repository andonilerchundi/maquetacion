<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="">
    
    <title>Laravel</title>

    @include('admin.layout.partials.style')
</head>

<body>

    <div class="wrapper">
        @include('admin.layout.partials.messages')
        @include('admin.layout.partials.loader')
        @include('admin.layout.partials.image')
        @include('admin.layout.partials.topbar')
        @if(isset($filters))
            @include('admin.layout.partials.filter', $filters)
        @endif
        <div class="body">
            @include('admin.layout.partials.sidebar')

            <div class="main"> 
                @yield('content')
            </div>
        </div>

        @if($agent->isMobile())
            @include('admin.layout.partials.bottombar')
        @endif
    </div>
    
    @include('admin.layout.partials.js')
</body>
</html>