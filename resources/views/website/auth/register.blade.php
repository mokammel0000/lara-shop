

@extends('website.layout')

@section('title')
Register
@endsection

{{-- {{ dd($errors->any());}}
{{ dd($errors->all());}} --}}


@section('content')
			<!-- register_section - start
			================================================== -->
			<section class="register_section sec_ptb_140 parallaxie clearfix" data-background="assets/images/backgrounds/bg_23.jpg">
				<div class="container">
					<div class="reg_form_wrap signup_form" data-background="assets/images/reg_bg_02.png">

					{{-- @if ($errors->any())
						<div class="alert alert-danger">
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
						</div>
					@endif  --}}

						<form action="{{ url('register') }}" method="POST">
							@csrf

							<div class="reg_form">
								<h2 class="form_title text-uppercase">Register</h2>

								<div class="form_item">
									<input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}">
									@error('name')
										<small class="text-danger"> {{$message}} </small>
									@enderror
								</div>

								<div class="form_item">
									<input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
									@error('email')
										<small class="text-danger"> {{$message}} </small>
									@enderror
								</div>

								<div class="form_item">
									<input type="tel" name="phone" placeholder="phone" value="{{ old('phone') }}">
									@error('phone')
										<small class="text-danger"> {{$message}} </small>
									@enderror
								</div>

								<div class="form_item">
									<input type="password" name="password" placeholder="Password">
									@error('password')
										<small class="text-danger"> {{$message}} </small>
									@enderror
								</div>

								<div class="form_item">
									<input type="password" name="password_confirmation" placeholder="Confirm Password">
									@error('password_confirmation')
										<small class="text-danger"> {{$message}} </small>
									@enderror
								</div>

								{{-- <div class="checkbox_item mb_30">
									<label for="agree_checkbox"><input id="agree_checkbox" type="checkbox"> I agree to the Terms of User</label>
								</div> --}}

								<button type="submit" class="custom_btn bg_default_red text-uppercase mb_50">
									Create Account
								</button>

								<div class="create_account text-center">
									<h4 class="small_title_text text-center text-uppercase">Have an account?</h4>
									<a class="create_account_btn text-uppercase" href="{{url('login')}}">Login</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</section>
			<!-- register_section - end
			================================================== -->
@endsection