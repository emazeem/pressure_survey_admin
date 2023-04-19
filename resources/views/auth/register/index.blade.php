@extends('layout.main')
@section('title')
    Register
@endsection
@section('content')
    <div class="action-div p-3" >
        <div class="action-div-inner">
            <div class="containetr">
                <div class="row justify-content-center">
                    <div class="col-md-4 col-sm-8 col-xs-12">
                        <div class="action-div-logo-inner" onclick="window.location.href='{{route('home')}}'">
                            @if (Route::CurrentRouteName()!= 'advertizer.signup')
                            <img src="{{asset('main-assets/images/logo.png')}}" alt="">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-div" >
        <div class="container">
            <div class="form-div-inner">
                <div class="form-div-main-upper d-flex justify-content-center" >
                    <div class="col-md-6 card ">
                        <div class="">
                            @if($role == \Role::Advertizer)
                            @include('auth.register.components.advertizer')
                            @else
                            @include('auth.register.components.register_html')
                            @endif    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{url('index.js')}}"></script>
    <script>
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $(function () {
            $(document).on('submit', '#register-avertizer-form', function (e) {
                e.preventDefault();
                $(this).find('.form-control.is-invalid').removeClass('is-invalid');
                $(this).find('.invalid-feedback.is-invalid').remove();
                $('#country_code').val($('.iti__selected-dial-code').text());
                var method = 'POST';
                var button = $(this).find('button[type=submit]');
                var previous = button.text();
                button.attr('disabled', 'disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Registering ...');
                $.ajax({
                    type: method,
                    url: '{{route('register')}}',
                    data: new FormData(this),
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function (data) {
                        button.attr('disabled', null).html(previous);
                        $.toast({
                            heading: 'Success',
                            text: 'Congratulations! Your account has been successfully created!',
                            icon: 'success',
                            position: 'top-right',
                            afterShown: function () {
                                window.location.reload();
                            }
                        });
                    },
                    error: function (xhr) {
                        button.attr('disabled', null).html(previous);
                        erroralert(xhr);
                    }
                });

            });

            $(document).on('click', '.show-password', function () {
                var target_input = $(this).attr('data-target');
                $(target_input).attr('type', 'text');
                $(this).removeClass('show-password').addClass('hide-password');
                $(this).html('<i class="fa fa-eye-slash" aria-hidden="true"></i>');
            });

            $(document).on('click', '.hide-password', function () {
                var target_input = $(this).attr('data-target');
                $(target_input).attr('type', 'password');
                $(this).removeClass('hide-password').addClass('show-password');
                $(this).html('<i class="fa fa-eye" aria-hidden="true"></i>');
            });

            $(document).on('click', '#verify-email', function () {
                if (!IsEmail($('#email').val())) {
                    $.toast({heading: 'Error', text: 'Please type valid email.!', icon: 'warning', position: 'top-right'});
                } else {
                    $('#email-text').text($('#email').val());
                    $('#2fa-modal').modal('show');
                }
            });
        });

        function IsEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(email)) {
                return false;
            } else {
                return true;
            }
        }

        function verifyCode() {
            if ($('#code').val()==$('#user_code').val()){

            } else{
                $.toast({heading: 'Error', text: '6-Digit code you type is incorrect.!', icon: 'warning', position: 'top-right'});
            }
        }
    </script>
    <script>
        $(function () {
            $(document).on('click','#send-code',function (e) {
                e.preventDefault();
                $('#2fa-modal').modal('show');
                var previous= $(this).text(),b=$(this);
                b.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing ...');

                $.ajax({
                    url: "{{route('sent.verification.email')}}",
                    data: {'email': $('#email').val(), _token: "{{csrf_token()}}",},
                    type: "POST",
                    dataType: "JSON",
                    complete:function() {
                        b.attr('disabled',null).html(previous);
                    },
                    success: function (data) {
                        if (data.success){
                            $('.verify-code-div').show();
                            $('.send-mail-div').hide();
                        }
                    },
                    error: function (xhr) {
                        erroralert(xhr);
                    },
                });
            });
            $(document).on('click','#check-code',function (e) {
                e.preventDefault();
                $('#2fa-modal').modal('show');
                var previous= $(this).text(),b=$(this);
                b.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing ...');
                $.ajax({
                    url: '{{route('email.verification')}}',
                    type: "POST",
                    dataType: "JSON",
                    data: {'email':$('#email').val(),'code':$('#code').val(),_token:'{{csrf_token()}}'},
                    success: function (data) {
                        b.attr('disabled',null).html(previous);
                        if (data.success==true){
                            $('#2fa-modal').modal('hide');
                            $('#email').addClass('is-valid').prop("readonly",true);
                            $("#register-btn").removeAttr('disabled');
                        } else{
                            $.toast({heading: 'Failed', text: 'Code doesn\'t matched', icon: 'error', position: 'top-right',});
                        }
                    },
                    error: function (xhr) {
                        b.attr('disabled',null).html(previous);
                        erroralert(xhr);
                    },
                });
            });
            $(document).on('click','#re-send-code',function (e) {
                e.preventDefault();
                $('.verify-code-div').hide();
                $('.send-mail-div').show();
            });
        });
    </script>

    <style>
        #user-image {
            width: 142px;
            height: 142px;
            border-radius: 50%;
            object-fit: cover;
        }
        .hidden-password.is-invalid {
            background: unset;
        }
    </style>
    <div class="modal fade" id="2fa-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form id="2fa-form">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fa fa-warning"></i> Email Verification</h5>
                        <button type="button" class="btn" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                    </div>
                    <div class="modal-body" style="min-height: 200px">
                        <div class="send-mail-div">
                            Click on button below to send 6-Digits for email verification. (<span id="email-text"></span>).
                            <br>
                            <br>
                            <a class="text-decoration-underline" href="javascript:void(0)" id="send-code">Send 6-Digit Code</a>
                        </div>
                        <div class="verify-code-div" style="display: none;">
                            <div class="col-md-12">
                                <label for="code">Please enter the 6-Digit Code sent to your email.</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value=""
                                           placeholder='XXXXXX' maxlength="6" name="code" required id="code">
                                    <div class="input-group-prepend">
                                        <button class="input-group-text btn border" id="check-code">Submit</button>
                                    </div>
                                </div>
                                <a class="text-decoration-underline" href="javascript:void(0)" id="re-send-code">Resend 6-Digit Code</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection