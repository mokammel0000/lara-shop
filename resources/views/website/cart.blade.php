

@extends('website.layout')

@section('title')
Cart
@endsection

@section('content')
			<!-- cart_section - start
			================================================== -->
			<section class="cart_section sec_ptb_50 clearfix">
				<div class="container">						
					<h2 class="mb-4"> <u> Your Cart </u> </h2>

					<div>
						<form action="{{ url('/update-cart') }}" method="POST">
							@csrf
							<div class="cart_table mb_50">
								<table class="table">
									<thead class="text-uppercase">
										<tr>
											<th>Product Name</th>
											<th>Price</th>
											<th>Quantity</th>
											<th>Total Price</th>
										</tr>
									</thead>
									<tbody>
										@php($subTotal = 0)
										@forelse ($products as $product)
											<tr>
												<td>
													<div class="cart_product">
														<div class="item_image">
															<img src="{{ asset( $product->featuredPhoto) }}" alt="image_not_found">
														</div>
														<div class="item_content">
															<h4 class="item_title"> {{ $product->name }} </h4>
															<span class="item_type"> {{ $product->category->name }} </span>
														</div>
														<button type="button" class="remove_btn" data-pid="{{ $product->id }}">
															<i class="fal fa-times"></i>
														</button>
													</div>
												</td>
												<td>
													<span class="price_text">
														{{ $product->price }}
													</span>
												</td>
												<td>
													<div class="quantity_input">
														<span class="input_number_decrement">–</span>
														<input class="input_number" type="text" name="quantity[{{$product->id}}]"
															value="{{ $product->pivot->quantity }}">
														<span class="input_number_increment">+</span>
													</div>
												</td>
												<td>
													<span class="total_price">
														{{ $product_total_price = $product->price * $product->pivot->quantity }}
													</span>
												</td>
											</tr>
											@php($subTotal += $product_total_price)
						
											@empty
											<tr >
												<td colspan="100%">
													<div class="alert alert-primary  ">
															<div class="row justify-content-center">
															Your cart is empty
														</div>
													</div>
												</td>
											</tr>
										@endforelse
									</tbody>
								</table>
								<div class="cart_update_btn" style="position:relative; left: 83%">
									<button type="submit" class="custom_btn bg_btn btn-primary text-uppercase" > 
										Update Cart
									</button>
								</div>
							</div>
						</form>
					</div>

					<div style="position:absolute; left: 140px; width: 450px; ">
						<form action="{{ url('/apply-coupon') }}" method="post" >
							@csrf
	
							@if (session('coupon_error'))
								<small style="position:relative; left: 20px; color:red">
									{{session('coupon_error')}}
								</small>
							@endif
	
							<div class="col">
								<div class="coupon_form" >
									<div class="form_item mb-0 " style="white-space: nowrap;">
										<input type="hidden" name="total" value="{{ $subTotal }}">
										<input type="text" value="{{$_GET['code'] ?? ''}}" 
											class="coupon" name="code" placeholder="Coupon Code" style="display: inline-block;">
										<button type="submit" class="custom_btn bg_danger text-uppercase ml-5" style="display: inline-block;">
											Apply Coupon
										</button>
									</div>
								</div>
							</div>
						</form>
					</div>

					<div class="row justify-content-lg-end">
						<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
							<div class="cart_pricing_table pt-0 text-uppercase" data-bg-color="#f2f3f5">
								<h3 class="table_title text-center" data-bg-color="#ededed">Cart Total</h3>
								<ul class="ul_li_block clearfix">
									<li>
										<span> Subtotal </span> 
										<span id="subtotal"> {{ $subTotal }} </span>
									</li>

									<li>
										<span> VAT </span> 
										<span id="vat">  {{ $vat = $subTotal * (14 / 100) }} </span>
									</li>

									<li>
										<span> Total </span> 
										<span id="total"> {{$total = $subTotal + $vat }} </span>
									</li>

									@isset($_GET['discount'])
										<li>
											<span> Total after discount </span> 
											<span id="total"> {{$total -  $_GET['discount'] }} </span>
										</li>
									@endisset
								</ul>
								<a href="{{ url('/checkout') }}" class="custom_btn bg_success"> 
									Proceed to Checkout
								</a>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- cart_section - end
			================================================== -->
@endsection