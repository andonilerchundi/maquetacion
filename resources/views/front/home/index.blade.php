@extends('front.master-clean')

@section("content")

    <div class="homepage">
        <div class="homepage-content"> 
            <div class="menu-bar-home">
                <p>{{display_menu("FAQ's",'horizontal')}}</p>
                <p>{{display_menu("Guantes",'horizontal')}}</p>
                <p>{{display_menu("Contacto",'horizontal')}}</p>
         
            </div>

            <div class="box-mandarina">
                
                <div class="lines"></div>
                <div class="punching"></div>
            
                <div class="leg right">
                    <div></div>
                </div>
                <div class="arm-container">
                    <div class="arm-right"></div>
                </div>	
                <div class="apple">
                    <div class="hairs"></div>
                    <div class="eyes"></div>
                    <div class="arm-left"></div>
                    <div class="leg left">
                        <div></div>
                    </div>
                </div>
                <div class="shadow"></div>
               



            </div>
        </div>




    </div>
   
@endsection