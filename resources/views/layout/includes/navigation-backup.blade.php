<div class="profile-site-navigation">
    <div class="container">
        <div class="profile-site-navigation-inner">
            <ul class="profile-site-navigation-ul">
                {{--<li class="profile-site-navigation-li {{(Route::currentRouteName()=='home')?'active':''}}">
					<a href="{{route('home')}}" class="profile-site-navigation-link"> <span class="icon">
                    <img src="{{url('ambassador_assets/images/nav-icon/home.png')}}" alt="">
                    </span> <span class="text">Timeline</span> </a>
				</li>
				--}}
                <li class="profile-site-navigation-li @if(Route::currentRouteName()=='ambassador.home') active @endif ">
                    <a href="javascript:void(0)" class="profile-site-navigation-link"> <span class="icon">
               <img src="{{url('main-assets/images/nav-icon/feed.png')}}" alt="">
               </span> <span class="text">Feeds</span> </a>
                    <div class="navigation-drop-down">
                        <div class="navigation-drop-down-inner">
                            <ul class="navigation-drop-down-">
                                <li class="navigation-drop-down-li home-posts" data-type="public">
                                    <a href="{{route('home')}}" class="navigation-drop-down-link">
                                        <div class="icon"><img
                                                    src="{{asset('ambassador_assets/images/icons/globe.svg')}}" alt="">
                                        </div>
                                        <div class="text">Public</div>
                                    </a>
                                </li>
                                <li class="navigation-drop-down-li home-posts" data-type="friends">
                                    <a href="{{route('home')}}" class="navigation-drop-down-link">
                                        <div class="icon"><img
                                                    src="{{asset('ambassador_assets/images/icons/users.svg')}}" alt="">
                                        </div>
                                        <div class="text">Friends</div>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </li>
                <li class="profile-site-navigation-li {{(Route::currentRouteName()=='ambassador.profile' or Route::currentRouteName()=='gallery')?'active':''}}">
                    <a href="javascript:void(0)" class="profile-site-navigation-link"> <span class="icon">
                        <img src="{{url('ambassador_assets/images/icons/user.png')}}" alt="">
                        </span> <span class="text">
                        Profile
                        </span>
                    </a>
                    <div class="navigation-drop-down">
                        <div class="navigation-drop-down-inner">
                            <ul class="navigation-drop-down-">
                                <li class="navigation-drop-down-li">
                                    <a href="{{route('ambassador.profile')}}" class="navigation-drop-down-link">
                                        <div class="icon"><img
                                                    src="{{asset('ambassador_assets/images/nav-icon/social-information.png')}}"
                                                    alt=""></div>
                                        <div class="text">Social Information</div>
                                    </a>
                                </li>
                                <li class="navigation-drop-down-li">
                                    <a href="{{route('gallery',['all'])}}" class="navigation-drop-down-link">
                                        <div class="icon"><img
                                                    src="{{asset('ambassador_assets/images/nav-icon/gallery.png')}}"
                                                    alt=""></div>
                                        <div class="text">Gallery</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="profile-site-navigation-li {{(Route::currentRouteName()=='network')?'active':''}}">
                    <a  href="javascript:void(0)"  class="profile-site-navigation-link"> <span class="icon">
                       <img src="{{url('main-assets/images/nav-icon/explore.png')}}" alt="">
                       </span> <span class="text" style="width:100px; text-align:center;">Explore</span>
                    </a>
                </li>
                <li class="profile-site-navigation-li {{(Route::currentRouteName()=='network')?'active':''}}">
                    <a  href="javascript:void(0)"  class="profile-site-navigation-link"> <span class="icon">
                       <img src="{{url('main-assets/images/nav-icon/chat.png')}}" alt="">
                       </span> <span class="text" style="width:100px; text-align:center;">Messages</span>
                    </a>
                </li>
                <li class="profile-site-navigation-li {{(Route::currentRouteName()=='network')?'active':''}}">
                    <a  href="javascript:void(0)"  class="profile-site-navigation-link"> <span class="icon">
                       <img src="{{url('main-assets/images/nav-icon/bell.png')}}" alt="">
                       </span> <span class="text" style="width:100px; text-align:center;">Notifications</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
</div>
</div>