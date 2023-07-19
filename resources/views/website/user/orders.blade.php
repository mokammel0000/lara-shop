@extends('website.layout')

@section('title')
Orders
@endsection

@section('content')
			<!-- Orders_section - start
			================================================== -->
			<section class="cart_section sec_ptb_50 clearfix">
				<div class="container">
					<h2> Your Orders </h2>
					@include('website.user.tabs')

					<table class="table table-bordered mt-3 bg-white">

						<thead>

						  <tr>
							<th scope="col"> Status </th>
							<th scope="col"> Payment Method </th>
							<th scope="col"> Address </th>
							<th scope="col"> Total </th>
							<th scope="col"> Date </th>
							<th scope="col"> Details </th>
							<th scope="col"> Cancel </th>
						  </tr>

						</thead>

						<tbody>
							@forelse ($orders as $order)
							<tr>
								{{-- status --}}
								<td scope="row"> 
									{{-- {{ $order->status }} --}}              {{-- 	THE REAL ATTRIBUTE --}}
									{{ $order->status_text }}                   {{-- 	ACCESSOR --}}
								</td>

								{{-- Payment Method --}}
								<td> 
									{{-- {{ $order->payment_method }}    --}}    {{-- 	THE REAL ATTRIBUTE --}}
									{{ $order->payment_method_text }}            {{-- 	ACCESSOR --}}
								</td>  

								{{-- Address --}}
								<td> 
									{{-- {{ empty($order->address) ? auth()->user()->address : $order->address  }} --}} 
									{{ $order->address ?: auth()->user()->address}}
								</td>

								{{-- Total --}}
								<td> 
									{{ round($order->total, 0) }} $
								</td>
								
								{{-- Date --}}
								<td> 
									{{-- {{ $order->created_at->toDayDateTimeString() }} --}}
									{{-- {{ $order->created_at->format('l jS \\of F Y') }} --}}
									{{-- {{ $order->created_at->format('h:i:s A') }} --}}
									{{ $order->created_at->format('D_j_F_Y') }}
								</td>

								{{-- Modal to show Details of the Order --}}
								<td>
									<!-- Button trigger modal -->
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal{{ $order->id }}">
										Show
									</button>
									
									<!-- Modal -->
									{{-- TAKE CARE OF THAT... HOW CAN WE LINK THE BUTTON WITH IT'S MODAL DIV, WE USE ORDER ID --}}
									<div class="modal fade" id="Modal{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-xl">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">
														{{ $order->created_at->toDayDateTimeString() }}
													</h5>

													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>

												<div class="modal-body">
													<table class="table">
														<thead class="text-uppercase">
															<tr>
																<th>Product Photo & Name</th>
																<th>Price</th>
																<th>Quantity</th>
																<th>Total Price</th>
															</tr>
														</thead>
														<tbody>
						
															@foreach ($order->products as $product)
						
															<tr>
																<td>
																	<div class="cart_product">
																		<div class="item_image">
																			<img src="{{
																			asset( $product->featuredPhoto)
																			}}"
																			alt="image_not_found">
																		</div>
																		<div class="item_content">
																			<h4 class="item_title">
																				{{ $product->name }}
																			</h4>
																			<span class="item_type">
																				{{ $product->category->name }}
																			</span>
																		</div>
																	</div>
																</td>
																<td>
																	<span class="price_text text-center">
																		{{ round($product->price , 1) }} $
																	</span>
																</td>
																<td class="text-center">
																	{{ $product->pivot->quantity }}
																</td>
																<td>
																	<span class="total_price text-center">
																		{{ round($total = $product->price * $product->pivot->quantity , 1) }}$
																	</span>
																</td>
															</tr>

															@endforeach
														</tbody>
													</table>
												</div>

												{{-- <div class="modal-footer">
													
													<button type="button" class="btn btn-secondary" data-dismiss="modal">
														Close
													</button>

													<button type="button" class="btn btn-primary">
														Save changes
													</button>
												</div> --}}
											</div>
										</div>
									</div>	
								</td>

								{{--Canciling the order if it was in some status --}}
								<td>
									
									@if ($order->status == App\Models\Order::STATUS_NEW  || $order->status == App\Models\Order::STATUS_IN_PROGRESS )
										<form action="{{ url('/cancel-order') }}" method="POST">
											@csrf
											<input type="hidden" name="order_id" value="{{ $order->id }}">

											<button type="submit" class="btn btn-danger">
												Cancel
											</button>
										</form>
									@endif
								</td>

							</tr>
							@empty
							<tr>
								<td colspan="100%">
									<div class="alert alert-warning text-center">
										No Orders Yet
									</div>
								</td>
							</tr>
								
							@endforelse

						  
						</tbody>

					  </table>
				</div>
			</section>
			<!-- Orders_section - end
			================================================== -->
@endsection