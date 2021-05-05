@if(isset($tab))
    
    <div class="language-bar-form">
                    
        <div class="tab-item-language language-active" id="español" data-tab="{{$tab}}" data-localetab="{{'es'}}">
            Español
        </div> 
        <div class="tab-item-language" id="ingles" data-tab="{{$tab}}" data-localetab="{{'en'}}" >
            Ingles
        </div>  

    </div>

    {{$slot}}

@endif

