@extends('front.master-clean')

@section('content')

    <div class="login_main">
        <form id="login-form" method="POST" action="{{route('front_login_submit')}}" >

            {{ csrf_field() }}

            <div class="svg_box">
                <svg  viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z" />
                </svg>
            </div>
            <label for="email">
                Email
            </label>
            <input type="email"  value="{{ old('email') }}" name="email">
            <label for="password" >
                Contraseña
            </label>
            <input input type="password"  name="password">

            <button type="submit">
               <span> Log In </span>
            </button>
        </form>    
        
    </div>

@endsection


