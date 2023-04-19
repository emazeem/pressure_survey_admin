
@extends('layout.main')
@section('title')
    Login
@endsection
@section('content')

    <div class="login-screen-wrapper">
        <div class="login-screen-wrapper-outer">
            <div class="login-screen-wrapper-inner">
                <div class="login-screen-wrapper-main">
                    <div class="login-screen-sides">
                        <div class="login-screen-sides-outer">
                            <div class="login-screen-sides-inner">
                                <div class="login-image">
                                    <div class="login-image-inner">
                                        <div class="login-image-main">
                                            <img src="{{url('SSGC_logo.png')}}"  alt="">
                                            <p><b>Pressure Survey</b></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="login-form">
                                    <div class="login-form-outer">
                                        <div class="login-form-inner">
                                            <div class="login-form-image">
                                                <div class="login-form-image-inner">
                                                   <p style="font-size: 35px; "> Login</p>
                                                </div>
                                            </div>
                                            <div class="login-form-box">
                                                {{--<div class="login-form-box-title">
                                                    Log in to Admin Panel
                                                </div>
                                                <div class="login-form-box--bottom-title">
                                                    Enter your email and password to sign in
                                                </div>
                                                --}}
                                                <div class="login-form-fields">
                                                    <form action="{{route('login')}}" id="login" method="post">
                                                        @csrf
                                                        <div class="login-form-fields-outer">
                                                            <div class="login-form-fields-inner">
                                                                <div class="login-form-field-single">
                                                                    <label id="email">Email</label>
                                                                    <input type="email" placeholder="Email" name="email" id="email" value="{{old('email')}}">
                                                                    <span class="text-danger">@error('email'){{$message}} @enderror</span>
                                                                </div>
                                                                <div class="login-form-field-single has-icon">
                                                                    <label id="password">Password</label>
                                                                    <input type="password" placeholder="Password" name="password" id="password" value="{{old('password')}}" class="hidden-password">
                                                                    <span class="text-danger">@error('password'){{$message}} @enderror</span>
                                                                    <span class="eye-icon show-password" data-target='.hidden-password'><i class="fa fa-eye" aria-hidden="true"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="forgot-password-link">
                                                            <a href="{{ route('password.request') }}">Forgot Password?</a>
                                                        </div>
                                                        <div class="login-button">
                                                            @if(url('') =='http://localhost:8000' || url('')=='http://127.0.0.1:8000')
                                                            <button>Login</button>
                                                        @else
                                                            <button class="g-recaptcha" data-sitekey="{{env('GOOGLE_CAPTCHA_SITE_KEY')}}" data-callback='onSubmit' data-action='submit'>Log in</button>
                                                        @endif
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://www.google.com/recaptcha/api.js"></script>
@push('scripts')
    <script>
        function onSubmit(token) {
            document.getElementById("login").submit();
        }
        $(document).on('click','.show-password',function(){
            var target_input = $(this).attr('data-target');
            console.log('hhh');
            $(target_input).attr('type','text');
            $(this).removeClass('show-password').addClass('hide-password')
            $(this).html('<i class="fa fa-eye-slash" aria-hidden="true"></i>');
        });

        $(document).on('click','.hide-password',function(){
            var target_input = $(this).attr('data-target');
            $(target_input).attr('type','password');
            $(this).removeClass('hide-password').addClass('show-password')
            $(this).html('<i class="fa fa-eye" aria-hidden="true"></i>');
        });
    </script>

@endpush
