@if(isset($tab))
    
    <div class="language-bar-form">

        @foreach ($localizations as $localization)
            <li class="tab-item-language {{ $loop->first ? 'language-active':'' }}" data-tab="{{$tab}}" data-localetab="{{$localization->alias}}">
                {{$localization->name}}
            </li> 

            
        @endforeach
                    
        
    </div>

    {{$slot}}

@endif

