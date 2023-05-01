<header class="header_section supermarket_header bg-white clearfix">
    {{-- <div class="header_top text-white clearfix">
        <div class="container maxw_1460">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-5">
                    <p class="welcome_text mb-0">Welcome to Worldwide Online marketplace Store</p>
                </div>

                <div class="col-lg-7">
                    <ul class="info_list ul_li_right clearfix">
                        <li><a href="#!"><i class="fal fa-map-marker-alt"></i> Store Locator</a></li>
                        <li><a href="#!"><i class="fal fa-truck"></i> Track Your Order</a></li>
                        <li>
                            <form action="#">
                                <div class="currency_select option_select mb-0">
                                    <select>
                                        <option value="USD" selected>US Dollars</option>
                                        <option value="EUR">Euro</option>
                                        <option value="GBP">UK Pounds</option>
                                    </select>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> --}}


    <div class="header_middle clearfix">
        <div class="container maxw_1460">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-3">
                    <div class="brand_logo">
                        <a class="brand_link" href="{{url('/')}}">
                            <img src="{{asset('assets/images/logo/logo_18_1x.png')}}"
                             srcset="{{asset('assets/images/logo/logo_18_2x.png 2x')}}" alt="logo_not_found">
                        </a>

                        <ul class="mh_action_btns ul_li clearfix">
                            <li>
                                <button type="button" class="search_btn" data-toggle="collapse" data-target="#search_body_collapse" aria-expanded="false" aria-controls="search_body_collapse">
                                    <i class="fal fa-search"></i>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="cart_btn">
                                    <i class="fal fa-shopping-cart"></i>
                                    <span class="btn_badge"> 
                                        {{$cartCount}}
                                     </span>
                                </button>
                            </li>
                            <li><button type="button" class="mobile_menu_btn"><i class="far fa-bars"></i></button></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6">
                    <form action="{{ url('/search-results') }}" method="GET">
                        <div class="medical_search_bar">
                            <div class="form_item">
                                <input type="search" name="keyword" placeholder="search here..." value="{{ $_GET['keyword'] ?? '' }}">
                            </div>
                            <div class="option_select mb-0">
                                <select name="category_id" value="{{ $_GET['category_id'] ?? '' }}">

                                    <option value="" data-display="All Category">
                                        Select A Option
                                    </option>
                                    
                                    @foreach ($cats as $category)
                                        <option value="{{ $category->id }}" >
                                        {{-- <option value="{{ $category->id }}" {{ $_GET['category_id'] == $category->id ? 'selected' : ''  }}> --}}
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <button type="submit" class="submit_btn"><i class="fal fa-search"></i></button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-2">
                    <div class="supermarket_header_btns clearfix">
                        <ul class="action_btns_group ul_li clearfix">

                            @if (Auth::check())

                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle text-dark"  role="button" 
                                data-toggle="dropdown" aria-expanded="false">
                                    <small> <b>Welcome,  {{Auth::user()->name}} </b>  </small>
                                </a>
                                <div class="dropdown-menu" >
                                    <a class="dropdown-item" href="{{url('profile')}}">
                                        <small> <b> Profile </b> </small>
                                    </a>

                                    <a class="dropdown-item" href="{{url('orders')}}">
                                        <small> <b> Orders </b> </small>
                                    </a>

                                    <a class="dropdown-item" href="{{url('change-password')}}">
                                        <small> <b> Change Password </b> </small>
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="{{url('logout')}}">
                                        <small> <b> Sign out </b> </small>
                                    </a>
                                    
                                    {{--  <a class="dropdown-item" href="#">Something else here</a> --}}
                                </div>
                            </li>

                            @else

                                <li style="margin-right: 0 !important">
                                    <a href="{{url('login')}}" class="btn btn-secondary btn-sm"
                                    style="background-color: #cc1414; color:white">
                                        Sign In
                                    </a>
                                </li>

                                <pre>  </pre>

                                <li style="margin-right: 0 !important">
                                    <a href="{{url('register')}}" class="btn btn-secondary btn-sm"
                                    style="background-color: #cc1414; color:white">
                                        New Account
                                    </a>
                                </li>

                            
                            @endif

                        </ul>
                    </div>
                </div>

                <div class="col-lg-1">
                    <div class="supermarket_header_btns clearfix">
                        <ul class="action_btns_group ul_li_right clearfix">
                            <li>
                                <a href="{{ Auth::check()? url('cart'): url('login')}}" class="cart_btn">
                                    <i class="fal fa-shopping-bag"></i>
                                    <span id="cartCount" class="btn_badge">
                                        {{ $cartCount }}
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>