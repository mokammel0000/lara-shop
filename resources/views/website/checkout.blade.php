

@extends('website.layout')

@section('title')
CheckOut
@endsection

@section('content')
			<!-- checkout_section - start
			================================================== -->
			<section class="checkout_section sec_ptb_50 clearfix">
				<div class="container">
					<form action="{{ url('/create-order') }}" method="POST">
						@csrf

						<div class="billing_form">
							<div class="form_wrap">
								<div class="form_item">
									<span class="input_title">Address</span>
									<textarea  name="address" placeholder="House number and street name"></textarea>
									@error('address')
										<small class="text-danger">
											{{-- {{$message}} --}}
											either add a specific address to this order, or add a default address in your profile
										</small>
									@enderror
								</div>
								<hr>
								<div class="form_item mb-0">
									<span class="input_title">Order notes</span>
									<textarea name="notes" placeholder="Note about your order, eg. special notes fordelivery."></textarea>
								</div>
								<hr>
								<div class="billing_payment_mathod">
									<ul class="ul_li_block clearfix">
										<li>
											<div class="checkbox_item mb-0 pl-0">
												<label for="cash_delivery">
													<input id="cash_delivery" type="radio" name="payment_method" value="1" checked>
														Cash On Delivery
												</label>
											</div>
										</li>
										<li>
											<div class="checkbox_item mb-0 pl-0">
												<label for="paypal_choise">
													<input id="paypal_choise" type="radio" name="payment_method" value="2"> 
													Paypal 
													<a href="https://www.paypal.com/eg/home" target="_blank"> 
														<img class="paypal_image" 
														src="assets/images/payment_methods_03.png" alt="image_not_found">
													</a>
												</label>
											</div>
										</li>
									</ul>
									<button type="submit" class="custom_btn bg_default_red">PLACE ORDER</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</section>
			<!-- checkout_section - end
			================================================== -->
@endsection