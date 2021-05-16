
@if($type == "image" )
    <div class="upload">      
        @foreach ($files as $image)
            @if($image->language == $alias)
                <div class="upload-thumb" data-label="{{$image->filename}}" style="background-image: url({{Storage::url($image->path)}})"></div>
            @endif
        @endforeach

        <span class="upload-prompt">@lang('admin/upload.image')</span>
        <input class="upload-input" type="file" name="images[{{$content}}.{{$alias}}]">
    </div>
    
    <p class="p">@lang('admin/form-titulos.image-single')</p>
    
    
@endif

@if($type == "multiple-images" )

    <div class="collection-box">
        <div class="upload-collection">      
            @foreach ($files as $image)
                @if($image->language == $alias)
                    <div class="upload-thumb" data-label="{{$image->filename}}" style="background-image: url({{Storage::url($image->path)}})"></div>
                @endif
            @endforeach
    
            <span class="upload-prompt">+</span>
            <input class="upload-input" type="file" name="images[{{$content}}.{{$alias}}]" multiple>
            
        </div>

    </div>

    <div class="collection-box">
        <div class="upload-collection">      
            @foreach ($files as $image)
                @if($image->language == $alias)
                    <div class="upload-thumb" data-label="{{$image->filename}}" style="background-image: url({{Storage::url($image->path)}})"></div>
                @endif
            @endforeach
    
            <span class="upload-prompt">+</span>
            <input class="upload-input" type="file" name="images[{{$content}}.{{$alias}}]" multiple>
            
        </div>

    </div>

    
   
   
    <p class="p">@lang('admin/form-titulos.image-multiple')</p>
    
@endif