@extends('frontend.master')

@section('home')


<!--================================
         START HERO AREA
=================================-->
    @include('frontend.home.hero_area')
<!--================================
        END HERO AREA
=================================-->

<!--======================================
        START FEATURE AREA
 ======================================-->
    @include('frontend.home.feature_area')
<!--======================================
       END FEATURE AREA
======================================-->

<!--======================================
        START CATEGORY AREA
======================================-->
    @include('frontend.home.category_area')
<!--======================================
        END CATEGORY AREA
======================================-->

<!--======================================
        START COURSE AREA
======================================-->
    @include('frontend.home.courses_area')
<!--======================================
        END COURSE AREA
======================================-->

<!--======================================
        START COURSE AREA
======================================-->
    @include('frontend.home.courses_area_two')
<!--======================================
        END COURSE AREA
======================================-->

<!-- ================================
       START FUNFACT AREA
================================= -->
    @include('frontend.home.funfact_area')
<!-- ================================
       START FUNFACT AREA
================================= -->

<!--======================================
        START CTA AREA
======================================-->
    @include('frontend.home.cta_area')
<!--======================================
        END CTA AREA
======================================-->

<!--================================
         START TESTIMONIAL AREA
=================================-->
    @include('frontend.home.testimonial_area')
<!--================================
        END TESTIMONIAL AREA
=================================-->

<div class="section-block"></div>

<!--======================================
        START ABOUT AREA
======================================-->
    @include('frontend.home.about_area')
<!--======================================
        END ABOUT AREA
======================================-->

<div class="section-block"></div>

<!--======================================
        START REGISTER AREA
======================================-->
    @include('frontend.home.register_area')
<!--======================================
        END REGISTER AREA
======================================-->

<div class="section-block"></div>

<!-- ================================
       START CLIENT-LOGO AREA
================================= -->
    @include('frontend.home.client_logo_area')
<!-- ================================
       START CLIENT-LOGO AREA
================================= -->

<!-- ================================
       START BLOG AREA
================================= -->
    @include('frontend.home.blog_area')
<!-- ================================
       START BLOG AREA
================================= -->

<!--======================================
        START GET STARTED AREA
======================================-->
    @include('frontend.home.get_started_area')
<!-- ================================
       START GET STARTED AREA
================================= -->

<!--======================================
        START SUBSCRIBER AREA
======================================-->
    @include('frontend.home.subscriber_area')
<!--======================================
        END SUBSCRIBER AREA
======================================-->

@endsection
