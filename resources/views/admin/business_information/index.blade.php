@php
    $route = 'business_information';
@endphp

@extends('admin.layout.table_form')

@section('form')

    <form class="formulario admin-form" action="{{route("business_information_store")}}">
    
        {{ csrf_field() }}

        <input autocomplete="false" name="hidden" type="text" style="display:none;">
        <input type="hidden" name="group" value="front/information">


        <div class="top-bar-form">

            <div class="left-top-bar">

                <div class="tab-items tab-active" data-tab="contenido">
                    <svg  viewBox="0 0 24 24">
                        <path fill="currentColor" d="M19,20H5V4H7V7H17V4H19M12,2A1,1 0 0,1 13,3A1,1 0 0,1 12,4A1,1 0 0,1 11,3A1,1 0 0,1 12,2M19,2H14.82C14.4,0.84 13.3,0 12,0C10.7,0 9.6,0.84 9.18,2H5A2,2 0 0,0 3,4V20A2,2 0 0,0 5,22H19A2,2 0 0,0 21,20V4A2,2 0 0,0 19,2Z" />
                    </svg>
                </div> 
                <div class="tab-items" data-tab="logo">
                    <svg  viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12,19.2C9.5,19.2 7.29,17.92 6,16C6.03,14 10,12.9 12,12.9C14,12.9 17.97,14 18,16C16.71,17.92 14.5,19.2 12,19.2M12,5A3,3 0 0,1 15,8A3,3 0 0,1 12,11A3,3 0 0,1 9,8A3,3 0 0,1 12,5M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12C22,6.47 17.5,2 12,2Z" />
                    </svg>
                </div>
                  
                <div class="tab-items" data-tab="socials">
                    <svg  viewBox="0 0 24 24">
                        <path fill="currentColor" d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z" />
                    </svg>
                </div> 
                <div class="tab-items" data-tab="presentacion">
                    <svg  viewBox="0 0 24 24">
                        <path fill="currentColor" d="M20,20H4A2,2 0 0,1 2,18V6A2,2 0 0,1 4,4H20A2,2 0 0,1 22,6V18A2,2 0 0,1 20,20M5,13V15H16V13H5M5,9V11H19V9H5Z" />
                    </svg>
                </div>  

            </div>

            <div class="right-top-bar">

                <button id="send">
                    <svg  viewBox="0 0 24 24">
                        <path fill="currentColor" d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z" />
                    </svg>
                </button>
            
               
            </div>
           
        </div>

       
       
        <div class="tab-panel tab-active" data-tab="contenido">
            @component('admin.layout.partials.locale', ['tab' => 'contenido'])

                @foreach ($localizations as $localization)

                    <div class="tab-panel-language {{ $loop->first ? 'language-active':'' }}" data-tab="contenido" data-localetab="{{$localization->alias}}">

                        <div class="two-columns">
                            <div class="form-group">
                                <div class="form-label">
                                    <label for="business" class="label-highlight">
                                        Teléfono 
                                    </label>
                                </div>
                                <div class="form-input">
                                    <input type="text" name="business[telephone.{{$localization->alias}}]" value="{{isset($business["telephone.$localization->alias"]) ? $business["telephone.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                </div>
                            </div>
                
                            <div class="form-group">
                                <div class="form-label">
                                    <label for="business" class="label-highlight">
                                        Email 
                                    </label>
                                </div>
                                <div class="form-input">
                                    <input type="text" name="business[email.{{$localization->alias}}]" value="{{isset($business["email.$localization->alias"]) ? $business["email.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                </div>
                            </div>
                        </div>
                        
                        <div class="two-columns">
                            <div class="form-group">
                                <div class="form-label">
                                    <label for="business" class="label-highlight">
                                        Provincia 
                                    </label>
                                </div>
                                <div class="form-input">
                                    <input type="text" name="business[province.{{$localization->alias}}]" value="{{isset($business["province.$localization->alias"]) ? $business["province.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                </div>
                            </div>
        
                            <div class="form-group">
                                <div class="form-label">
                                    <label for="business" class="label-highlight">
                                        Población 
                                    </label>
                                </div>
                                <div class="form-input">
                                    <input type="text" name="business[poblation.{{$localization->alias}}]" value="{{isset($business["poblation.$localization->alias"]) ? $business["poblation.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                </div>
                            </div>
                        </div>
        
                        <div class="two-columns">
                            <div class="form-group">
                                <div class="form-label">
                                    <label for="business" class="label-highlight">
                                        Código Postal 
                                    </label>
                                </div>
                                <div class="form-input">
                                    <input type="text" name="business[postalcode.{{$localization->alias}}]" value="{{isset($business["postalcode.$localization->alias"]) ? $business["postalcode.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                </div>
                            </div>
        
                            <div class="form-group">
                                <div class="form-label">
                                    <label for="business" class="label-highlight">
                                        Dirección 
                                    </label>
                                </div>
                                <div class="form-input">
                                    <input type="text" name="business[adress.{{$localization->alias}}]" value="{{isset($business["adress.$localization->alias"]) ? $business["adress.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                </div>
                            </div>
                        </div>
                        
                        <div class="two-columns">
                            <div class="form-group">
                                <div class="form-label">
                                    <label for="business" class="label-highlight">Horario</label>
                                </div>
                                <div class="form-input">
                                    <input type="text" name="business[schedule.{{$localization->alias}}]" value="{{isset($business["schedule.$localization->alias"]) ? $business["schedule.$localization->alias"] : ''}}" class="input-highlight">
                                </div>
                            </div>
                        </div>

                    </div>

                @endforeach
            @endcomponent

        </div>
       

        <div class="tab-panel" data-tab="logo">

            @component('admin.layout.partials.locale', ['tab' => 'logo'])

                @foreach ($localizations as $localization)
                    

                    <div class="tab-panel-language {{ $loop->first ? 'language-active':'' }}" data-tab="logo" data-localetab="{{$localization->alias}}">

                        <div class="two-columns">

                            <div class="form-group">
                                <div class="form-label">
                                    <label for="name" class="label-highlight">Logo</label>
                                </div>
                                <div class="form-input">
                                    @include('admin.layout.partials.upload', [
                                        'entity' => 'business_information',
                                        'type' => 'single', 
                                        'content' => 'logo', 
                                        'alias' => $localization->alias,
                                        'files' => $business->images_logo_preview
                                    ])
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-label">
                                    <label for="name" class="label-highlight">Logo Negativo</label>
                                </div>
                                <div class="form-input">
                                    @include('admin.layout.partials.upload', [
                                        'entity' => 'business_information',
                                        'type' => 'single', 
                                        'content' => 'logolight', 
                                        'alias' => $localization->alias,
                                        'files' => $business->images_logolight_preview
                                    ])
                                </div>
                            </div>

                        </div>

                    </div>

                @endforeach


            @endcomponent


        </div>

        <div class="tab-panel" data-tab="socials">

            @component('admin.layout.partials.locale', ['tab' => 'socials'])

                @foreach ($localizations as $localization)

                    <div class="tab-panel-language {{ $loop->first ? 'language-active':'' }}" data-tab="socials" data-localetab="{{$localization->alias}}">

                        <div class="one-columns">
                            
                            <div class="form-group">
                                <div class="form-label">
                                    <label for="business" class="label-highlight">
                                        Instagram
                                    </label>
                                </div>
                                <div class="form-input">
                                    <input type="text" name="business[instagram.{{$localization->alias}}]" value="{{isset($business["instagram.$localization->alias"]) ? $business["instagram.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-label">
                                    <label for="business" class="label-highlight">
                                        Facebook 
                                    </label>
                                </div>
                                <div class="form-input">
                                    <input type="text" name="business[facebook.{{$localization->alias}}]" value="{{isset($business["facebook.$localization->alias"]) ? $business["facebook.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-label">
                                    <label for="business" class="label-highlight">
                                        Twitter 
                                    </label>
                                </div>
                                <div class="form-input">
                                    <input type="text" name="business[twitter.{{$localization->alias}}]" value="{{isset($business["twitter.$localization->alias"]) ? $business["twitter.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-label">
                                    <label for="business" class="label-highlight">
                                        Whatsapp
                                    </label>
                                </div>
                                <div class="form-input">
                                    <input type="text" name="business[whatsapp.{{$localization->alias}}]" value="{{isset($business["whatsapp.$localization->alias"]) ? $business["whatsapp.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                </div>
                            </div>
                        </div>

                    </div>

                @endforeach
        
            @endcomponent

        </div>

        <div class="tab-panel" data-tab="presentacion">

            @component('admin.layout.partials.locale', ['tab' => 'presentacion'])

                @foreach ($localizations as $localization)
                    <div class="tab-panel-language {{ $loop->first ? 'language-active':'' }}" data-tab="presentacion" data-localetab="{{$localization->alias}}">

                        <div class="one-column">
                            <div class="form-group">
                                <div class="form-label">
                                    <label for="business" class="label-highlight">Eslogan</label>
                                </div>
                                <div class="form-input">
                                    <input type="text" name="business[slogan.{{$localization->alias}}]" value="{{isset($business["slogan.$localization->alias"]) ? $business["slogan.$localization->alias"] : ''}}" class="input-highlight">
                                </div>
                            </div>
                        </div>

                        <div class="two-columns">
                            <div class="form-group">
                                <div class="form-label">
                                    <label for="business" class="label-highlight">
                                        Nuestra compañía
                                    </label>
                                </div>
                                <div class="form-input">
                                    <textarea class="ckeditor input-highlight" name="business[ourbusiness.{{$localization->alias}}]">{{isset($business["ourbusiness.$localization->alias"]) ? $business["ourbusiness.$localization->alias"] : ''}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-input">
                                    @include('admin.layout.partials.upload', [
                                        'entity' => 'business-information',
                                        'type' => 'single', 
                                        'content' => 'ourbusiness', 
                                        'alias' => $localization->alias,
                                        'files' => $business->images_our_business_preview
                                    ])
                                </div>
                            </div>
                        </div>

                        <div class="two-columns">
                            <div class="form-group">
                                <div class="form-input">
                                    @include('admin.layout.partials.upload', [
                                        'entity' => 'business-information',
                                        'type' => 'single', 
                                        'content' => 'ourfleet', 
                                        'alias' => $localization->alias,
                                        'files' => $business->images_our_fleet_preview
                                    ])
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-label">
                                    <label for="business" class="label-highlight">
                                        Nuestra flota
                                    </label>
                                </div>
                                <div class="form-input">
                                    <textarea class="ckeditor input-highlight" name="business[ourfleet.{{$localization->alias}}]">{{isset($business["ourfleet.$localization->alias"]) ? $business["ourfleet.$localization->alias"] : ''}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>


                @endforeach
            @endcomponent
        </div>    
    
    
    
    
    
    
    </form>


    
@endsection