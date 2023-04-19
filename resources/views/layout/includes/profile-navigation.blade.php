<div class="profile-navigation">
    <div class="container">
        <div class="profile-navigation-inner">
            <div class="profile-navigation-nav">
                <div class="inner-navigation-logo to-show-sticky">
                    <div class="inner-navigation-logo-image">
                        <img src="{{asset('ambassador_assets/images/logo.png')}}" alt="">
                    </div>
                </div>
                <div class="profile-navigation-ul-outer">
                    <div class="profile-navigation-ul-box to-show-menu-01">
                        <ul class="profile-navigation-ul">
                            <li class="profile-navigation-li {{Route::currentRouteName()=='home'?'active':''}}"><a href="{{route('home')}}" class="profile-navigation-link">Home</a></li>
                            <li class="profile-navigation-li {{Route::currentRouteName()=='ambassador.profile'?'active':''}}"><a href="{{route('ambassador.profile')}}" class="profile-navigation-link">Social Information</a></li>
                            <li class="profile-navigation-li {{Route::currentRouteName()=='gallery'?'active':''}}"><a href="{{route('gallery',['all'])}}" class="profile-navigation-link">Gallery</a></li>
                            <li class="profile-navigation-li
                           {{in_array(Route::currentRouteName(),['network.list','network'])?'active':''}}"
                            ><a href="{{auth()->user()->id==$user->id ? route('network',['type'=>'friends']) : route('network.list',['type'=>'friends','id'=>$user->id])}}" class="profile-navigation-link">Networks</a></li>
                        </ul>
                    </div>
                    <div class="mobile-menu-icon top-open-menu" data-target=".to-show-menu-01">
                        <div class="mobile-menu-icon-inner">
                            <span class="ti-menu"></span>
                        </div>
                    </div>
                </div>
                <div class="inner-navigation-sub-menu to-show-sticky">
                    <div class="inner-navigation-sub-menu-inner">
                        <div class="inner-navigation-sub-menu-main"></div>
                        <ul class="inner-navigation-sub-menu-ul">
                            <li class="inner-navigation-sub-menu-li hover position dropdown-box  open-dropdown" data-target=".drop-00124">
                                <span class="nav-icon"><span class="ti-layout-grid4-alt"></span></span>
                                <div class="inner-mega-menu custom-dropdown drop-00124">
                                    <div class="inner-mega-menu-inner">
                                        <div class="inner-mega-menu-main">
                                        <ul class="inner-mega-navigation-ul">
                                            <li class="inner-mega-navigation-li black-bg">
                                                <a href="javascript:void(0)" class="inner-mega-navigation-link">
                                                    <span class="icon">
                                                        <img src="{{asset('ambassador_assets/images/icons/coin.svg')}}" alt="">
                                                    </span>
                                                    <span class="text">$100</span>
                                                </a>
                                            </li>
                                            <li class="inner-mega-navigation-li active">
                                                <a href="javascript:void(0)" class="inner-mega-navigation-link">
                                                    <span class="icon">
                                                        <img src="{{asset('ambassador_assets/images/nav-icon/black-social.png')}}" alt="">
                                                    </span>
                                                    <span class="text">
                                                        Social
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="inner-mega-navigation-li">
                                                <a href="javascript:void(0)" class="inner-mega-navigation-link">
                                                    <span class="icon">
                                                        <img src="{{asset('ambassador_assets/images/nav-icon/black-network.png')}}" alt="">
                                                    </span>
                                                    <span class="text">Network</span>
                                                </a>
                                            </li>
                                            <li class="inner-mega-navigation-li">
                                                <a href="javascript:void(0)" class="inner-mega-navigation-link">
                                                    <span class="icon">
                                                        <img src="{{asset('ambassador_assets/images/nav-icon/black-shop.png')}}" alt="">
                                                    </span>
                                                    <span class="text">Shops</span>
                                                </a>
                                            </li>
                                            <li class="inner-mega-navigation-li">
                                                <a href="javascript:void(0)" class="inner-mega-navigation-link">
                                                    <span class="icon">
                                                        <img src="{{asset('ambassador_assets/images/nav-icon/black-bill.png')}}" alt="">
                                                    </span>
                                                    <span class="text">Receipts</span>
                                                </a>
                                            </li>
                                            <li class="inner-mega-navigation-li">
                                                <a href="javascript:void(0)" class="inner-mega-navigation-link">
                                                    <span class="icon">
                                                        <img src="{{asset('ambassador_assets/images/nav-icon/black-incentive.png')}}" alt="">
                                                    </span>
                                                    <span class="text">Incentives</span>
                                                </a>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="inner-navigation-sub-menu-li hover"><span class="nav-icon"><span class="ti-bell"></span></span></li>
                            <li class="inner-navigation-sub-menu-li">
                                <div class="inner-navigation-sub-menu-li-profile dropdown-box  open-dropdown" data-target=".drop-0012">
                                    <div class="profile-user-options-icon">
                                        <img src="{{auth()->user()->profile_image()}}" alt="" class="profile_photo_preview">
                                    </div>
                                    <div class="user-dropdown-inner custom-dropdown left-dropdown drop-0012">
                                        <ul class="user-dropdown-ul">
                                            <li class="user-dropdown-li">
                                                <a href="{{route('ambassador.profile')}}">My Profile</a>
                                            </li>
                                            <li class="user-dropdown-li">
                                                    <a href="javascript:void(0)" class="open-modal" data-modal="#Send-InvitationModal">Send Invite</a>
                                                </li>
                                            <li class="user-dropdown-li">
                                                <a href="javascript:void(0)">Settings</a>
                                            </li>
                                            <li class="user-dropdown-li">
                                                <a ref="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">Log out
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

