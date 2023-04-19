@extends('layout.main')

@section('content')
    <script src="{{url('main-assets/js/index.js')}}"></script>
    <div class="form-div">
        <div class="container">
            <div class="form-div-inner">
                <div class="form-div-main-upper">
                    <div class="col-md-12">
                        <div class="form-div-main">
                            @if($account)
                                @if($tokenverify)
                                    <form id="change-password">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$user->id}}">
                                        <input type="hidden" name="verification" value="{{$token}}">
                                        <div class="form-box text-center">
                                            <div class="form-title pb-3">
                                                <h2>Create New Password</h2>
                                            </div>
                                            <div class="form-field mb-4 has-icon">
                                                <input type="password" class="form-field-input form-control hidden-password"
                                                       name="password" placeholder="Enter new password">
                                                       <span class="eye-icon show-password" data-target='.hidden-password'><i class="fa fa-eye" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="form-field mb-4">
                                                <input type="password" class="form-field-input form-control hidden-password"
                                                       name="password_confirmation" placeholder="Confirm new password">
                                            </div>
                                            <div class="form-action-button">
                                                <button class="custom-black-btn mr-3" type="submit">Reset Password</button>
                                                <a href="{{route('login')}}" class="custom-black-btn">Back</a>
                                            </div>
                                        </div>
                                    </form>
                                    <script>
                                        $(function () {
                                           $('#change-password').submit(function (e) {
                                               e.preventDefault();
                                               var route = '{{route('forgot.change.password')}}';
                                               var method = 'POST';
                                               var data = new FormData(this);
                                               var next = {'type':'next-route','url':'{{route('login')}}'};
                                               submit($(this).find('button[type=submit]'),method,route,data,next);
                                           });
                                        });
                                    </script>
                                @else
                                    <div class="form-box text-center">
                                        <h2>Your link is expired.</h2>
                                    </div>
                                @endif
                            @else
                                <div class="form-box text-center">
                                    <h2>User not found</h2>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .swal-text{
            text-align: center;
        }
    </style>
@endsection

@push('scripts')

<script>
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