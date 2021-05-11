@extends('front.master')

@section('content')

    <div class="faqs">

        @foreach($faqs as $faq)
            <div class="faq">
                <div class="faq-header">
                    <div class="faq-title">
                        <h2>{{isset($faq->locale['title']) ? $faq->locale['title'] : ""}}</h2>
                    </div>
                    <div class="faq-button" data-button="{{$faq->id}}">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path d="M22,4V2H2V4H11V18.17L5.5,12.67L4.08,14.08L12,22L19.92,14.08L18.5,12.67L13,18.17V4H22Z" />
                        </svg>
                    </div>
                </div>
                <div class="faq-description" data-content="{{$faq->id}}">
                    <p>{!!isset($faq->locale['description']) ? $faq->locale['description'] : "" !!}</p>

                    @isset($faq->image_featured->path)
                        <div class="faq-description-image">
                            <img src="{{Storage::url($faq->image_featured->path)}}" alt="{{$faq->image_featured->alt}}" title="{{$faq->image_featured->title}}" />
                        </div>
                    @endif
                </div>
                
            </div>
        @endforeach
        
    </div>

@endsection


