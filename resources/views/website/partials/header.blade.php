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
                                    <span class="btn_badge">2</span>
                                </button>
                            </li>
                            <li><button type="button" class="mobile_menu_btn"><i class="far fa-bars"></i></button></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6">
                    <form action="#">
                        <div class="medical_search_bar">
                            <div class="form_item">
                                <input type="search" name="search" placeholder="search here...">
                            </div>
                            <div class="option_select mb-0">
                                <select>
                                    <option data-display="All Category">Select A Option</option>
                                    <option value="1">Some option</option>
                                    <option value="2">Another option</option>
                                    <option value="3" disabled>A disabled option</option>
                                    <option value="4">Potato</option>
                                </select>
                            </div>
                            <button type="submit" class="submit_btn"><i class="fal fa-search"></i></button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-3">
                    <div class="supermarket_header_btns clearfix">
                        <ul class="action_btns_group ul_li_right clearfix">
                            <li>
                                <button type="button">
                                    <span>Need</span>
                                    <strong>Help?</strong>
                                </button>
                            </li>
                            <li>
                                <button type="button">
                                    <span>Your</span>
                                    <strong>Account</strong>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="cart_btn">
                                    <i class="fal fa-shopping-bag"></i>
                                    <span class="btn_badge">2</span>
                                </button>
                            </li>
                        </ul>
                        <span class="alart_text float-right">
                            <small>£</small>
                            New here? Get your Coupons!
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>