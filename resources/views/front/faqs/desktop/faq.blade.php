<div class="faq">

    <div class="faq-title">
        <h3>{{isset($faq->seo->title) ? $faq->seo->title : ""}}</h3>
    </div>
    
    <div class="faq-content">
        <div class="faq-description">
        
            @isset($faq->image_featured_desktop->path)
                <div class="faq-description-image">
                    <img src="{{Storage::url($faq->image_featured_desktop->path)}}" alt="{{$faq->image_featured_desktop->alt}}" title="{{$faq->image_featured_desktop->title}}" />
                </div>
            @endif

            <div class="faq-description-text">
                {!!isset($faq->locale['description']) ? $faq->locale['description'] : "" !!}
            </div>
        </div>
    </div>
    
</div>
