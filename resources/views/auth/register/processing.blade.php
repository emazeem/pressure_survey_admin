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

    <div class="form-div " id="verify-account" style="margin-top:13%">
        <div class="container verify-container">
            <div class="form-div-inner">
                <div class="form-div-main-upper d-flex justify-content-center">
                    <div class="col-md-7 card">
                        <div class="form-div-main mb-0">
                            <form id="verify-code">
                                @csrf
                                <div class="form-box text-center">
                                    <div class="form-title mb-3 multi d-flex justify-content-between">
                                        @if(auth()->user()->details->kyc_status==1)
                                        <p class="bg bg-warning text-white rounded p-1 mt-2">Under Review</p>
                                        @endif
                                        @if(auth()->user()->details->kyc_status==3)
                                        <p class="bg bg-danger text-white rounded p-1 mt-2">Rejected</p>
                                        @endif
                                        <img src="{{asset('main-assets/images/center.png')}}" alt="" id="site-pre-loader-img" width="50px">
                                        <div class="email-verify-div-logout pt-2">
                                            <a href="" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"><i
                                            class="fa fa-sign-out"></i> Log out</a>
                                        </div>
                                    </div>
                                    @if(auth()->user()->details->kyc_status==1)
                                    <div class="text-left">
                                        <h6>Your account is under review, you will get an email when your account will approved by admin.</h6>
                                        <br>
                                    @endif
                                    @if(auth()->user()->details->kyc_status==3)
                                    <div class="text-left">
                                        <h5>Your account is rejected by admin 
                                        </h5>
                                        <h6>Rejected Reason : {{auth()->user()->details->kyc_reject_reason}}</h6>
                                        <br>
                                    @endif
                                        <h4>Thankyou</h4>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

<form id="logout-form" method="post" action="{{ route('logout') }}">
    @csrf
</form>

    {{-- <div id="full-page">
        <div class="site-pre-loader-inner">
            <img src="{{asset('main-assets/images/center.png')}}" alt="" id="site-pre-loader-img">
        </div>
        <h1 id="pre-loader">Processing...</h1>
    </div> --}}
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
