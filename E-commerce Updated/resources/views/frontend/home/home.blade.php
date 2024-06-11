@extends('frontend.layouts.master')

@section('content')


    <!--============================
        BANNER PART 2 START
    ==============================-->
    @include('frontend.home.sections.banner-slider')
    <!--============================
        BANNER PART 2 END
    ==============================-->

    <!--============================
        HOT DEALS START
    ==============================-->
    @include('frontend.home.sections.hot-deals')
    <!--============================
        HOT DEALS END
    ==============================-->

    <!--============================
        Promo SELL START
    ==============================-->
    @include('frontend.home.sections.flash-sale')
    <!--============================
        Promo SELL END
    ==============================-->


    <!--============================
        Advertisement Banner One
    ==============================-->
    @include('frontend.home.sections.advertisement-banner-one')
    <!--============================
        Advertisement Banner One
    ==============================-->


    <!--============================
        FLASH Out START
    ==============================-->
        @include('frontend.home.sections.flash-out')
    <!--============================
        FLASH Out END
    ==============================-->

     <!--============================
        BRAND SLIDER START
    ==============================-->
    @include('frontend.home.sections.brand-slider')
    <!--============================
        BRAND SLIDER END
    ==============================-->


    <!--============================
        SINGLE BANNER START
    ==============================-->
        @include('frontend.home.sections.advertisement-banner-two')
    <!--============================
        SINGLE BANNER END
    ==============================-->

    <!--============================
        ELECTRONIC PART START
    ==============================-->
        @include('frontend.home.sections.category-product-slider-one')
    <!--============================
        ELECTRONIC PART END
    ==============================-->


    <!--============================
        ELECTRONIC PART START
    ==============================-->
        @include('frontend.home.sections.category-product-slider-two')
    <!--============================
        ELECTRONIC PART END
    ==============================-->


    <!--============================
        LARGE BANNER  START
    ==============================-->
        @include('frontend.home.sections.advertisement-banner-four')
    <!--============================
        LARGE BANNER  END
    ==============================-->

@endsection
