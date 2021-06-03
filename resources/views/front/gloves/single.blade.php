@extends('front.master')

@section('title')@lang('front/seo.web-name') | {{$glove->seo->title}} @stop
@section('description'){{$glove->seo->description != null? $glove->seo->description : $glove->seo->locale_seo->description}} @stop
@section('keywords'){{$glove->seo->keywords != null ? $glove->seo->keywords : $glove->seo->locale_seo->keywords}} @stop
@section('facebook-url'){{URL::asset('/gloves/' . $glove->seo->slug)}} @stop
@section('facebook-title'){{$glove->seo->title}} @stop
@section('facebook-description'){{$glove->seo->description != null ? $glove->seo->description : $glove->seo->locale_seo->description}} @stop

@section("content")
    @if($agent->isDesktop())
        <div class="page-section" id="product">
            @include("front.gloves.desktop.glove")
        </div>
    @endif

    @if($agent->isMobile())
        <div class="page-section" id="product">
            @include("front.gloves.mobile.glove")
        </div>
    @endif
@endsection
        