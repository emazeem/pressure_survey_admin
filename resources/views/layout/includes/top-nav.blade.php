@push('scripts')
@if (\Session::has('message'))
    <script>
        $(function () {
            //swal("KYC", "{!! Session::get('message') !!}", "warning")

            $.toast({
                heading: 'Warning',
                text: "{!! Session::get('message') !!}",
                icon: 'warning',
                position: 'top-right',
            });
        });
    </script>
    <?php \Session::forget('message') ?>
@endif
@endpush
<div class="profile-top-bar">
<div class="profile-top-bar-inner">
    <div class="profile-top-bar-main">
        <div class="profile-top-bar-profile">
            <div class="profile-top-bar-profile-menu open">
                {{-- <div class="icon">
                    @if (Route::currentRouteName() != 'advertizer.signup')
                    <img src="{{asset('main-assets/images/top-navigation/menu.png')}}" alt="">
                    @else
                          <h6>Signup</h6>
                    @endif
                </div> --}}
                
            </div>
        </div>
        <div class="top-bar-site-logo">
            <div class="top-bar-site-logo-inner">
                <div class="top-bar-site-logo-image ">
                    <a href="{{route('home')}}">
                        <img src="{{asset('main-assets/images/logo.png')}}" alt="">
                    </a>
                </div>
            </div>
        </div>
        <div class="top-bar-site-navigation">
            <div class="top-bar-site-navigation-inner">
                <ul class="top-bar-site-navigation-ul">
                    <li class="top-bar-site-navigation-li">
                        {{-- @if (Route::currentRouteName() != 'advertizer.signup')
                        <a href="" class="top-bar-site-navigation-link">
                            <div class="icon-image">
                                <img src="{{asset('main-assets/images/top-navigation/bell.png')}}" alt="">
                            </div>
                        </a>
                        @endif --}}
                    </li>
                    {{-- <li class="top-bar-site-navigation-li">
                        <a href="javascript:void(0)" class="top-bar-site-navigation-link">
                            <div class="icon-image">
                                <img src="{{asset('main-assets/images/top-navigation/search.png')}}" alt="">
                            </div>
                        </a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
</div>
</div>


    {{-- Closing In Navigation Files --}}
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
<div id="search-box-skeletel" class="d-none">
    @include('layout.skeletel.search-box')
</div>
<div id="cart"></div>
<script src="{{url('main-assets/js/index.js')}}"></script>
@push('scripts')
        <script src="{{asset('main-assets/js/pusher.min.js')}}"></script>

<script>
    $(function () {



        $(document).on('click','.notification-outer',function(){
            $('.notification-dropdown').toggle();
        });
        $(document).on('submit','#reportForm',function(e){
            e.preventDefault();
            var button = $('#submit-report-btn'),previous=button.text();
            button.attr('disabled', 'disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing ...');

            $(this).find('.form-control.is-invalid').removeClass('is-invalid');
            $(this).find('.invalid-feedback.is-invalid').remove();

          
        });
        fetchNotifications();

    });
   
    $(document).ready(function() {
        //fetch UnreadNotification
        unReadNotification();
        // Init Vars
        var dropdown_box = ".notification-dropdown-box";
        var dropdown_class = ".custom-notification-dropdown";
        
        // Open DropDown
        $(document).on('click','.open-notification-dropdown',function() {
            var target = $(this).attr('data-target')
            console.log(target)
            if (!check_activity($(target))) {
                $(target).addClass('active');
            } else {
                $(target).removeClass('active');
            }
        });

        // Helper Function
        function check_activity(element) {
            return (element.hasClass('active')) ? true : false ;
        }

        // Close on Document Click
        $(window).click(function(event) {
            if (!$(event.target).closest(dropdown_box).length){
                $(dropdown_class).removeClass('active');
            }
        });

    });

    $('.profile-top-bar-profile-menu.open').click(function(){
        console.log('sdsd')
        $('.profile-top-bar-profile-menu-inner-box').show();
    });
    $('.menu-profile-top-section-close').click(function(){
        $('.profile-top-bar-profile-menu-inner-box').hide();
    });
</script>
@endpush