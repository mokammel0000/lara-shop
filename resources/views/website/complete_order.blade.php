

@extends('website.layout')

@section('title')
Completed
@endsection

@section('content')
			<!-- checkout_section - start
			================================================== -->
			<section class="checkout_section sec_ptb_140 clearfix">
				<div class="container">

					<div class="order_complete_alart text-center">
						<h2>Congratulation! You’ve <strong>Completed</strong> Order.</h2>
						
						
					</div>

					<div class="text-center mt-2">
						<a href="{{ url('/') }}" class=" d-block p-2 bg-dark text-white">
							Home Page
						</a>
					</div>

					{{-- <ul class="checkout_step ul_li clearfix">
						<li class="activated"><a href="shop_checkout.html"><span>01.</span> Shopping Cart</a></li>
						<li class="activated"><a href="shop_checkout_step2.html"><span>02.</span> Checkout</a></li>
						<li class="active"><a href="shop_checkout_step3.html"><span>03.</span> Order Completed</a></li>
					</ul> --}}	

				</div>
			</section>
			<!-- checkout_section - end
			================================================== -->
@endsection