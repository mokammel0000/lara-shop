@extends('website.layout')

@section('title')
Profile
@endsection

@section('content')
			<!-- profile_section - start
			================================================== -->
			<section class="cart_section sec_ptb_50 clearfix">
				<div class="container">
					<h2> Your Profile </h2>
					@include('website.user.tabs')
					{{-- THE SUCCESS AND ERROR MESSAGES ARE IN TABS FILE --}}

					<form action="{{ url('/profile') }}" method="POST" class="mt-3">
						@csrf

						<div class="reg_form">
							<div class="form_item">
								<input type="text" placeholder="Full Name" name="name" value="{{ $user->name }}">
							</div>

							<div class="form_item">
								<input type="email" placeholder="email" name="email" value="{{ $user->email }}">
							</div>

							<div class="form_item">
								<input type="tel" placeholder="phone" name="phone" value="{{ $user->phone }}">
							</div>

							<div class="form_item">
								<textarea name="address" cols="15" rows="4">
									{{ $user->address }}
								</textarea>
							</div>

							<button type="submit" class="custom_btn bg_default_red text-uppercase mb_50">
								Update Account
							</button>
						</div>
					</form>
					

				</div>
			</section>
			<!-- profile_section - end
			================================================== -->
@endsection