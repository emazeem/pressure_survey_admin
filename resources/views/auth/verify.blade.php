@extends('layout.main')
@section('title')
    Verify
@endsection
@section('content')
<style>
    #full-page #pre-loader {
    font-size: 26px;
    margin-top: 15px;
}
div#full-page {
    width: 100%;
    height: 100%;
    position: absolute;
    background: #f0f2f5;
    top: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}
</style>
    <div class="form-div" id="verify-account">
        <div class="container verify-container" style="display: none">
            <div class="form-div-inner">
                <div class="form-div-main-upper">
                    <div class="col-md-10">
                        <div class="form-div-main mb-0">
                        @if(auth()->user()->is_disabled==0)
                            <form id="verify-code">
                                @csrf
                                <div class="form-box text-center">
                                    <div class="form-title pb-3 multi">
                                        @if(auth()->user()->is_visible==1)
                                        <h2>Welcome back to Connect Social</h2>
                                        @else
                                        <h2>Email Verification</h2>
                                        @endif
                                        <div class="email-verify-div-logout">
                                            <a href="" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"><i
                                            class="fa fa-sign-out"></i> Log out</a>
                                        </div>
                                    </div>
                                    <div class="form-sub-title">
                                        @if(auth()->user()->is_visible==0)
                                        <p class="mb-3">We have just sent you a verification code on
                                            <b>{{auth()->user()->email}}</b><br>
                                            Please enter your verification code to activate your account.
                                        </p>
                                        @else
                                        <p class="mb-3">A verification email is sent to your email account associated with Connect Social.
                                          <b>{{auth()->user()->email}}</b><br>
                                          Please enter the 6-digit OTP to reactivate your account.
                                        </p>
                                        @endif
                                    </div>
                                    <div class="form-field mb-4">
                                        <input type="number" class="form-field-input form-control"
                                               placeholder="Enter one time code" name="code">
                                    </div>
                                    <div class="form-action-button">
                                        <button class="custom-black-btn mr-3" id="submit-code" type="submit">Submit</button>
                                        <button class="custom-black-btn mr-3" id="resend-code" type="button">Resend
                                            Code
                                        </button>
                                    </div>
                                </div>
                            </form>
                            @else
                                <div class="form-title pb-3 d-flex justify-content-between">
                                    <h2>Your account was disabled by admin.</h2>
                                    <div class="email-verify-div-logout">
                                        <a href="{{route('login')}}" ><i class="fa fa-sign-out"></i> Log out</a>
                                    </div>
                                </div>
                            <br>
                            <h3>Reason</h3>
                            <div class="form-text text-muted mb-3">
                                {{auth()->user()->reason_deactive_admin }}
                            </div>
                        @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

<form id="logout-form" method="post" action="{{ route('logout') }}">
    @csrf
</form>

    <div id="full-page">
        <div class="site-pre-loader-inner">
            <img src="{{asset('main-assets/images/center.png')}}" alt="" id="site-pre-loader-img">
        </div>
        <h1 id="pre-loader">Processing...</h1>
    </div>
    <script>
     
        $(function () {
            $(document).on('click','#logout-btn',function (e) {
                e.preventDefault();
                $('#logout-form').trigger('submit');
            });
            $(document).on('submit', '#verify-code', function (e) {
                e.preventDefault();
                $(this).find('.form-control.is-invalid').removeClass('is-invalid');
                $(this).find('.invalid-feedback.is-invalid').remove();
                var b = $(this).find('button[type=submit]');
                var previous = b.text();
                b.attr('disabled', 'disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing ...');
                $.ajax({
                    type: 'POST',
                    url: '{{route('email.verify.code')}}',
                    data: new FormData(this),
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend:function(){
                        $("#resend-code").attr("disabled", true);
                    },
                    success: function (data) {
                        localStorage.removeItem("mail-send");
                        b.attr('disabled', null).html(previous);
                        $('#resend-code').attr("disabled", false);
                        $.toast({
                            heading: 'Success',
                            text: data.success,
                            icon: 'success',
                            position: 'top-right',
                            afterShown: function () {
                                window.location.href = '{{route('home')}}';
                            }
                        });
                    },
                    error: function (xhr) {
                        b.attr('disabled', null).html(previous);
                        $('#resend-code').attr("disabled", false);
                        erroralert(xhr);
                    }
                });
            });
            $(document).on('click', '#resend-code', function (e) {
                e.preventDefault();
                var route = '{{route('email.resend.code')}}';
                var method = 'GET';
                var data = {_token: '{{csrf_token()}}'};
                var b = $(this);
                var previous = b.text();
                b.attr('disabled', 'disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing ...');
                $.ajax({
                    type: method,
                    url: route,
                    data: data,
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend:function(){
                        $('#submit-code').attr('disabled',true);
                    },
                    success: function (data) {
                        b.attr('disabled', null).html(previous);
                        $('#submit-code').attr('disabled',false);
                        $.toast({
                            heading: 'Success',
                            text: data.success,
                            icon: 'success',
                            position: 'top-right',
                        });
                    },
                    error: function (xhr) {
                        b.attr('disabled', null).html(previous);
                        $('#submit-code').attr('disabled',false);
                        erroralert(xhr);
                    }
                });



            });
            @if(auth()->user()->send_email == 0)
            sendEmail();
            @else
            $('#full-page').hide();
            $('.verify-container').show();
            @endif
        });


        function sendEmail() {
            $.ajax({
                type: "POST",
                url: "{{route('sent.verification.email')}}",
                data: {_token: "{{csrf_token()}}",},
                dataType: "json",
                beforeSend: function () {
                    $('#pre-loader').text(' Please wait! A Verification code is being sent to your email.');
                },
                success: function (data) {
                    if (data.response == 'sent') {
                        $('#pre-loader').text('Email sent successfully.!');
                    }
                    $('#full-page').hide();
                    $('.verify-container').show();
                },
                error: function (xhr) {
                    erroralert(xhr);
                }
            });
        }
     </script>
    <style>
        div#full-page {
            width: 100%;
            height: 100%;
            position: absolute;
            background: #f0f2f5;
            top: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endsection
