@extends('website.layout')

@section('title')
Change Password
@endsection

@section('content')
			<!-- Change_password_section - start
			================================================== -->
			<section class="cart_section sec_ptb_50 clearfix">
				<div class="container">
					<h2> Change Password </h2>
					@include('website.user.tabs')


					<form action="{{ url('/change-password') }}" method="POST" class="mt-3">
						@csrf

						<div class="reg_form">
							<div class="form_item">
								<input type="password" name="old_password" placeholder="Old Password">
							</div>

							<div class="form_item">
								<input type="password" name="password" placeholder="Password">
							</div>

							<div class="form_item">
								<input type="password" name="password_confirmation" placeholder="Confirm Password">
							</div>

							<button type="submit" class="custom_btn bg_default_red text-uppercase mb_50">
								Change Password
							</button>
						</div>
					</form>
					
				</div>
			</section>
			<!-- Change_password_section - end
			================================================== -->
@endsection