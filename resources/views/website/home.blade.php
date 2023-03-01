@extends('website.layout')

@section('title')
Home Page
@endsection
@section('buttom_header')
@include('website.partials.headerButtom')
@endsection
@section('content')

			<!-- sidebar mobile menu & sidebar cart - start
			================================================== -->
			@include('website.partials.sidebar_menu')
			<!-- sidebar mobile menu & sidebar cart - end
			================================================== -->


			<!-- slider_section - start
			================================================== -->
			@include('website.partials.slider')
			<!-- slider_section - end
			================================================== -->


			<!-- policy_section - start
			================================================== -->
			
			<!-- policy_section - end
			================================================== -->


			<!-- deals_section - start
			================================================== -->
			@include('website.partials.deals')
			<!-- deals_section - end
			================================================== -->


			<!-- product_section - start
			================================================== -->
			
			<!-- product_section - end
			================================================== -->


			<!-- advertisement_section - start
			================================================== -->
			
			<!-- advertisement_section - end
			================================================== -->


			<!-- bestseller_section - start
			================================================== -->
			@include('website.partials.bestseller')
			<!-- bestseller_section - end
			================================================== -->


			<!-- advertisement_section - start
			================================================== -->
			
			<!-- advertisement_section - end
			================================================== -->


			<!-- supermarket_feature_carousel - start
			================================================== -->
			
			<!-- supermarket_feature_carousel - end
			================================================== -->


			<!-- bestseller_section - start
			================================================== -->
			
			<!-- bestseller_section - end
			================================================== -->

@endsection

