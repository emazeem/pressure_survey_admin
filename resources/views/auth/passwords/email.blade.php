@extends('layout.main')

@section('content')
<div class="form-div">
    <div class="container">
        <div class="form-div-inner">
            <div class="form-div-main-upper">
                <div class="col-md-12">
                    <div class="form-div-main">
                        <form method="post" action="{{route('forgot.send.email')}}">
                            @csrf
                            <div class="form-box text-center">
                                <div class="form-title pb-3">
                                    <h2>Forgot Password</h2>
                                </div>
                                <div class="form-sub-title">
                                    <p class="mb-1">Enter your email address to receive a password reset link.</p>
                                </div>
                                <div class="form-field mb-4">
                                    <input type="email" class="form-field-input form-control" placeholder="Enter your email" name="email">
                                    <span class="text-danger">@error('email'){{$message}} @enderror</span>
                                </div>
                                <div class="form-action-button">
                                    <button class="custom-black-btn" type="submit">Reset Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

