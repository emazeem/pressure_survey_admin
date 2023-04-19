{{-- <div class="bottom-navigation">
    <div class="bottom-navigation-inner">
        <div class="bottom-navigation-main">
            <ul class="bottom-navigation-ul">
                <li class="bottom-navigationli">
                    <a href="{{route('home')}}" class="bottom-navigation-link">
                        <div class="bottom-navigation-link-inner">
                            <div class="icon"><img src="{{asset('main-assets/images/bottom-navigation/home.png')}}" alt=""></div>
                            <div class="text">Feed</div>
                        </div>
                    </a>
                </li>
                <li class="bottom-navigationli position-relative explore-popup-dropdown">
                    <a href="javascript:void(0)" class="bottom-navigation-link">
                        <div class="bottom-navigation-link-inner">
                            <div class="icon"><img src="{{asset('main-assets/images/bottom-navigation/explore.png')}}" alt=""></div>
                            <div class="text">Explore</div>
                        </div>
                    </a>
                    <div class="explore-popup">
                        <div class="explore-popup-inner">
                            <div class="explore-popup-main">
                                <ul class="explore-popup-ul">
                                    <li class="explore-popup-li">
                                        <a href="{{route('network',['friends'])}}" class="explore-popup-link">
                                            <div class="d-flex-custom">
                                                <div class="icon">
                                                    <img src="{{asset('main-assets/images/bottom-navigation/friends.png')}}" alt="">
                                                </div>
                                                <div class="text">Friends</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="explore-popup-li">
                                        <a href="{{route('search')}}" class="explore-popup-link">
                                            <div class="d-flex-custom">
                                                <div class="icon">
                                                    <img src="{{asset('main-assets/images/bottom-navigation/search.png')}}" alt="">
                                                </div>
                                                <div class="text">Explore NP Social</div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="bottom-navigationli big no-hover has-dropdown add-post-drop-down">
                    <a href="javascript:void(0)" class="bottom-navigation-link">
                        <div class="bottom-navigation-link-inner post-icon">
                            <div class="icon borderd"><img src="{{asset('main-assets/images/bottom-navigation/add.png')}}" alt=""></div>
                            <div class="text">Post</div>
                        </div>
                    </a>
                    <div class="add-post-popup">
                        <div class="add-post-popup-inner">
                            <div class="add-post-popup-list">
                                <ul class="add-post-popup-list-ul">
                                    <li class="add-post-popup-list-li">
                                        <a href="javascript:void(0)" class="add-post-popup-list-link add-post-link" data-type="audio">
                                            <div class="d-flex-custom">
                                                <div class="icon">
                                                    <img src="{{asset('main-assets/images/bottom-navigation/mic.png')}}" alt="">
                                                </div>
                                                <div class="text">
                                                    Upload Audio
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="add-post-popup-list-li">
                                        <a href="javascript:void(0)" class="add-post-popup-list-link add-post-link" data-type="video">
                                            <div class="d-flex-custom">
                                                <div class="icon">
                                                    <img src="{{asset('main-assets/images/bottom-navigation/video.png')}}" alt="">
                                                </div>
                                                <div class="text">
                                                    Upload Video
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="add-post-popup-list-li">
                                        <a href="javascript:void(0)" class="add-post-popup-list-link add-post-link" data-type="image">
                                            <div class="d-flex-custom">
                                                <div class="icon">
                                                    <img src="{{asset('main-assets/images/bottom-navigation/image.png')}}" alt="">
                                                </div>
                                                <div class="text">
                                                    Upload Picture
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="add-post-popup-list-li">
                                        <a href="javascript:void(0)" class="add-post-popup-list-link">
                                            <div class="d-flex-custom">
                                                <div class="icon">
                                                    <img src="{{asset('main-assets/images/bottom-navigation/text.png')}}" alt="">
                                                </div>
                                                <div class="text">
                                                    Simple Post
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="bottom-navigationli">
                    <a href="{{route('chat')}}" class="bottom-navigation-link">
                        <div class="bottom-navigation-link-inner">
                            <div class="icon"><img class='c-01' src="{{asset('main-assets/images/bottom-navigation/message.png')}}" alt=""></div>
                            <div class="text">Message</div>
                        </div>
                    </a>
                </li>
                <li class="bottom-navigationli">
                    <a href="{{route('ambassador.profile')}}" class="bottom-navigation-link">
                        <div class="bottom-navigation-link-inner">
                            <div class="icon"><img class="c-02 rounded-image" src="{{auth()->user()->profile_image()}}" alt=""></div>
                            <div class="text">Profile</div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="profile-top-bar-profile-menu-inner-box">
    <div class="profile-top-bar-profile-menu-inner-box-overlay">
        <div class="menu-profile-top-section">
            <div class="menu-profile-top-section-close">
                <div class="close-menu">
                    <img src="{{asset('main-assets/images/top-navigation/close.png')}}" alt="">
                </div>
            </div>
        </div>
        <div class="menu-profile-section">
            <div class="menu-profile-section-inner">
                <div class="menu-profile-section-profile-image">
                    <img src="{{auth()->user()->profile_image()}}" alt="">
                </div>
                <div class="menu-profile-section-profile-name">
                    {{auth()->user()->fullName()}}
                </div>
            </div>
        </div>
        <div class="profile-top-bar-profile-menu-list">
            <div class="profile-top-bar-profile-menu-list-inner">
                <ul class="profile-top-bar-profile-menu-list-ul">
                    <li class="profile-top-bar-profile-menu-list-li">
                        <a href="{{route('home')}}" class="profile-top-bar-profile-menu-list-link">
                            <div class="profile-top-bar-profile-menu-list-link-inner">
                                <div class="icon"><img src="{{asset('main-assets/images/bottom-navigation/home.png')}}" alt=""></div>
                                <div class="text">Feed</div>
                            </div>
                        </a>
                    </li>
                    <li class="profile-top-bar-profile-menu-list-li">
                        <a href="{{route('search')}}" class="profile-top-bar-profile-menu-list-link">
                            <div class="profile-top-bar-profile-menu-list-link-inner">
                                <div class="icon"><img src="{{asset('main-assets/images/top-navigation/search.png')}}" alt=""></div>
                                <div class="text">Explore NP Social</div>
                            </div>
                        </a>
                    </li>
                    <li class="profile-top-bar-profile-menu-list-li">
                        <a href="{{route('network',['friends'])}}" class="profile-top-bar-profile-menu-list-link">
                            <div class="profile-top-bar-profile-menu-list-link-inner">
                                <div class="icon"><img src="{{asset('main-assets/images/bottom-navigation/friends.png')}}" alt=""></div>
                                <div class="text">Friend List</div>
                            </div>
                        </a>
                    </li>
                    <li class="profile-top-bar-profile-menu-list-li">
                        <a href="{{route('chat')}}" class="profile-top-bar-profile-menu-list-link">
                            <div class="profile-top-bar-profile-menu-list-link-inner">
                                <div class="icon"><img src="{{asset('main-assets/images/bottom-navigation/message.png')}}" alt=""></div>
                                <div class="text">Messages</div>
                            </div>
                        </a>
                    </li>
                    <li class="profile-top-bar-profile-menu-list-li">
                        <a href="{{route('notification.show')}}" class="profile-top-bar-profile-menu-list-link">
                            <div class="profile-top-bar-profile-menu-list-link-inner">
                                <div class="icon"><img src="{{asset('main-assets/images/top-navigation/bell.png')}}" alt=""></div>
                                <div class="text">Notifications</div>
                            </div>
                        </a>
                    </li>
                    <li class="profile-top-bar-profile-menu-list-li">
                        <a href="{{route('settings',['blocking'])}}" class="profile-top-bar-profile-menu-list-link">
                            <div class="profile-top-bar-profile-menu-list-link-inner">
                                <div class="icon"><img src="{{asset('main-assets/images/top-navigation/setting.png')}}" alt=""></div>
                                <div class="text">Settings</div>
                            </div>
                        </a>
                    </li>
                    <li class="profile-top-bar-profile-menu-list-li">
                        <a onclick="event.preventDefault();document.getElementById('logout-form').submit();" style="cursor: pointer"
                           class="profile-top-bar-profile-menu-list-link">
                            <div class="profile-top-bar-profile-menu-list-link-inner">
                                <div class="icon"><img src="{{asset('main-assets/images/top-navigation/logout.png')}}" alt=""></div>
                                <div class="text">Logout</div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
<div class="show-add-post-popup"></div>

@push('scripts')
<script>
    $(document).ready(function(){
        $(document).on('click','.add-post-drop-down',function(){
            $('.show-add-post-popup').show();
            $('.bottom-navigation-link-inner.post-icon .icon').addClass('rotate-animate')
            $('.add-post-popup').show();
            $('.bottom-navigation').css('overflow','unset');
            $(this).addClass('close-post-drop-down').removeClass('add-post-drop-down');
        });

        $(document).on('click','.close-post-drop-down',function(){
            $('.show-add-post-popup').hide();
            $('.bottom-navigation-link-inner.post-icon .icon').removeClass('rotate-animate')
            $('.add-post-popup').hide();
            $('.bottom-navigation').css('overflow','hidden');
            $(this).removeClass('close-post-drop-down').addClass('add-post-drop-down');
        });
    });

    $(document).ready(function(){
        $(document).on('click','.explore-popup-dropdown',function(){
            $('.show-add-post-popup').show();
            $('.explore-popup').show();
            $('.bottom-navigation').css('overflow','unset');
            $(this).addClass('close-explore-popup-dropdown').removeClass('explore-popup-dropdown');
        });

        $(document).on('click','.close-explore-popup-dropdown',function(){
            $('.show-add-post-popup').hide();
            $('.explore-popup').hide();
            $('.bottom-navigation').css('overflow','hidden');
            $(this).removeClass('close-explore-popup-dropdown').addClass('explore-popup-dropdown');
        });
    });
</script>
@endpush --}}