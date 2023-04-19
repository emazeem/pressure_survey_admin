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
        <div class="container">
            <div class="profile-top-bar-main">
                <div class="profile-top-bar-wallete">
                    <a >
                        <div class="profile-top-bar-wallete-inner">
                            <div class="profile-wallete-coin-image">
                                <img src="{{url('main-assets/images/icons/coin.png')}}" alt="">
                            </div>
                            <div class="profile-wallete-text">
                                <div class="profile-wallete-top-text">
                                    My Balance
                                </div>
                                <div class="profile-wallete-balance">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="site-logo">
                    <div class="site-logo-inner">
                        <div class="site-logo-main">
                            <a href="{{url('')}}">
                            <img src="{{url('main-assets/images/logo.png')}}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="profile-user-options">
                    <div class="profile-user-options-inner">
                        <div class="profile-user-options-main">
                            <div class="line-show">
                            </div>
                            <ul class="profile-user-options-ul">
                                <li class="profile-user-options-li">
                                    <div class="profile-user-options-inner notification-dropdown-box">
                                        <div class="profile-user-options-icon   show-count open-notification-dropdown" data-target='.notification-dropdown'>
                                            <span class="ti-bell"></span>
                                            <span class="notifications-counter" id="notifiy-counter"></span>
                                            <div class="notification-dropdown custom-notification-dropdown">
                                                <div class="notification-dropdown-inner">
                                                    <div class="notification-dropdown-main">
                                                        <div class="notification-title d-flex">
                                                            <img src="{{url('main-assets/images/icons/bell-trans.gif')}}" alt="" width="30"> <b class="mt-1">Notifications</b>
                                                        </div>
                                                        <div class="notification-list">
                                                            <ul class="notification-ul">
                                                                <li class="notification-li skeletel-card">
                                                                    <div class="notification-skeletel-card-inner">
                                                                        <div class="notification-skeletel-image">
                                                                            <div class="notification-skeletel-image-main height-001 width-001 skeletel-image mr-2 s-animate"></div>
                                                                        </div>
                                                                        <div class="notification-skeletel-content">
                                                                            <div class="line mb-2 s-animate"></div>
                                                                            <div class="line width-001 s-animate"></div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <a href="javascript:void(0)" class="notification-link view-all">
                                                            <div class="notification-div">
                                                                View all
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="profile-user-options-li">
                                    <div class="profile-user-options-inner">
                                        <div class="profile-user-options-icon">
                                            <div class="search-input-home-navigation-inner dropdown-box">
                                                <div class="search-input-home-navigation-main">
                                                    <button class="hover-button search-button-popup open-dropdown"
                                                        data-target=".search-menu-02"><span
                                                        class="ti-search p3-padding"></span></button>
                                                </div>
                                                <div class="recent-searches-box custom-dropdown search-menu-02"
                                                    id="recent-searches-box" style="display: none;">
                                                    <div class="recent-searches-box-inner">
                                                        <div class="recent-searches-box-main">
                                                            <div class="search-input-home-navigation-main">
                                                                <form action="{{route('search')}}"
                                                                    method="get">
                                                                    <input type="text" id="search_by_value"  name="search_by_value" class="d-none" value="ambassador">
                                                                    <div class="back-btn close-recent-search"
                                                                        onclick="document.getElementById('recent-searches-box').style.display = 'none'">
                                                                        <span class="ti-close"></span>
                                                                    </div>
                                                                    <input type="text" placeholder="Search NP Social"
                                                                        name="key" class="key-drop-down"
                                                                        id="key-dropdown" required=""
                                                                        autocomplete="off">
                                                                    <button class="search-btn black-button"
                                                                        type="submit"><span
                                                                        class="ti-search"></span></button>
                                                                </form>
                                                            </div>
                                                            <div class="recent-search-box position">
                                                                <div class="title multi">
                                                                    <div class="text">Search By</div>
                                                                    <div class="search-by-outer">
                                                                        <div class="search-by-inner">
                                                                            <div class="current-search-by">
                                                                                <div class="text-inner">
                                                                                    <div class="text" id="search_by_text">Ambassadors</div>
                                                                                    <div class="icon"><span class="ti-filter"></span></div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="search-by-main">
                                                                                <ul class="search-by-ul search-of">
                                                                                    <li class="search-by-li" data-value='ambassador' data-text='Ambassadors'>
                                                                                        <div class="text">Ambassadors</div>
                                                                                    </li>
                                                                                    <li class="search-by-li" data-value='merchant' data-text='Merchants'>
                                                                                        <div class="text">Merchants</div>
                                                                                    </li>
                                                                                    <li class="search-by-li"  data-value='product' data-text='Products'>
                                                                                        <div class="text">Products</div>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="recent-search-list">
                                                                    <ul class="recent-search-ul" id="search-box-ul">
                                                                        <li class="recent-search-li">
                                                                            <div class="recent-search-list-div">
                                                                                <div class="recent-search-list-inner">
                                                                                    <div class="recent-search-rofile">
                                                                                        <div class="profile-text">
                                                                                            <small><i>No recent searches</i></small>
                                                                                        </div>
                                                                                    </div>
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
                                        </div>
                                    </div>
                                </li>

                                <li class="profile-user-options-li user-pic open-dropdown dropdown-box"
                                    data-target=".drop-00">
                                    <div class="profile-user-options-inner">
                                        <div class="profile-user-options-icon">
                                            <img src="{{auth()->user()->profile_image()}}" alt=""
                                                class="profile_photo_preview">
                                        </div>
                                        <div class="user-dropdown-inner drop-00 custom-dropdown left-dropdown">
                                            <ul class="user-dropdown-ul">
                                                <li class="user-dropdown-li">
                                                    <a href="{{route('ambassador.profile')}}"><i class="ti-user"></i> My
                                                    Profile</a>
                                                </li>
                                                <li class="user-dropdown-li">
                                                    <a href="javascript:void(0)" class="open-modal"
                                                        data-modal="#Send-InvitationModal"><i class="ti-share"></i> Send
                                                    Invite</a>
                                                </li>
                                                <li class="user-dropdown-li">
                                                    <a href="{{route('settings',['blocking'])}}"><i class="ti-settings"></i>
                                                    Settings</a>
                                                </li>
                                                <li class="user-dropdown-li">
                                                    <a href="{{route('kyc.submission')}}"><span class="ti-money"></span>
                                                    KYC Status
                                                    </a>
                                                </li>
                                                <li class="user-dropdown-li">
                                                    <a href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();"><i
                                                        class="fa fa-sign-out"></i> Log out</a>
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

            $.ajax({
                type : "post",
                url  : "{{route('report.post')}}",
                data : new FormData(this),
                dataType : "json",
                contentType : false,
                processData : false,
                cache : false,
                success : function(data) {
                    button.attr('disabled', null).html(previous);
                    $.toast({ heading: 'Success', text: data.success, icon: 'success', position: 'top-right' });
                    $('#report-modal').modal('hide');
                    $('#reportForm').trigger('reset');
                },
                error : function(xhr) {
                    button.attr('disabled', null).html(previous);
                    erroralert(xhr);
                }
            })
        });
        fetchNotifications();

    });
    function fetchNotifications() {
        var html = '<li class="notification-li skeletel-card">\n' +
            '                         <div class="notification-skeletel-card-inner">\n' +
            '                             <div class="notification-skeletel-image">\n' +
            '                                 <div class="notification-skeletel-image-main height-001 width-001 skeletel-image mr-2 s-animate"></div>\n' +
            '                            </div>\n' +
            '                             <div class="notification-skeletel-content">\n' +
            '                                 <div class="line mb-2 s-animate"></div>\n' +
            '                                 <div class="line width-001 s-animate"></div>\n' +
            '                             </div>\n' +
            '                         </div>\n' +
            '                       </li>';
        $('.notification-ul').html(html);
        $.ajax({
            url: '{{route('notification.fetch')}}',
            type: "POST",
            data: {_token: '{{csrf_token()}}'},
            dataType: "JSON",
            success: function (data) {
                $('.notification-ul').html(data);
            },
            error: function (xhr) {
                erroralert(xhr);
            },
        });
    }

    $(function () {
        Pusher.logToConsole = false;
        var pusher = new Pusher('2cd0e268445c56eb6d8d', {
            cluster: 'ap2'
        });
        var channel = pusher.subscribe('channel-notification');
        channel.bind('App\\Events\\Notifications', function (response) {

            if (response.to == {{auth()->user()->id}}){
                $.toast({
                    heading: 'Success',
                    text: response.msg,
                    icon: 'success',
                    position: 'top-right',
                });
                unReadNotification();
                fetchNotifications();        
            }
        });
    });
    
    function unReadNotification()
    {
        $.ajax({
            type : 'post',
            url : "{{route('unread.notifications')}}",
            data: { _token:"{{csrf_token()}}"},
            success:function(data)
            {
              if(data.notifications<=0){
                $('#notifiy-counter').removeClass('count');
              }else{
                $('#notifiy-counter').addClass('count');
              $('#notifiy-counter').text(data.notifications);  
              }
            },
            error:function(xhr){
                erroralert(xhr);
            }
        })
    }
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
</script>
@endpush