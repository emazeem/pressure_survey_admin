@extends('layout.main')
@section('title')
    Register
@endsection
@section('content')
    <div class="action-div p-3">
        <div class="action-div-inner">
            <div class="containetr">
                <div class="row justify-content-center">
                    <div class="col-md-4 col-sm-8 col-xs-12">
                        <div class="action-div-logo-inner" onclick="window.location.href='{{route('home')}}'">
                            <img src="{{asset('main-assets/images/logo.png')}}" alt="" class="w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-div">
        <div class="container">
            <div class="form-div-inner">
                <div class="form-div-main-upper">
                    <div class="col-md-12">
                        <div class="form-div-main custom-card custom-border custom-shadow">
                            @include('auth.register.components.register_html')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $('#email').val('{{$user->email}}').prop('disabled',true);
            $('#phone').val('{{$user->phone}}');
            $('#user-image').attr('src','{{$user->profile_image()}}');
            $('#fname').val('{{$user->fname}}');
            $('#lname').val('{{$user->lname}}');
            $('#username').val('{{$user->username}}');
            $('#gender').val('{{$user->gender}}');
            $('#npi').val('{{$user->details->npi}}');
            $('#dob').val('{{$user->details->date_of_birth}}');
            $('#register-btn').removeAttr('disabled');
            $('#verify-email').remove();
            $('<input>', {
                type: 'hidden',
                id: 'id',
                name: 'id',
                value: '{{$user->id}}'
            }).appendTo('#register-form');
            $(document).on('submit', '#register-form', function (e) {
                e.preventDefault();
                $(this).find('.form-control.is-invalid').removeClass('is-invalid');
                $(this).find('.invalid-feedback.is-invalid').remove();
                $('#country_code').val($('.iti__selected-dial-code').text());
                var method = 'POST';
                var button = $(this).find('button[type=submit]');
                var previous = button.text();
                button.attr('disabled', 'disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing ...');
                $.ajax({
                    type: method,
                    url: '{{route('sign.up.re.store')}}',
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
                                window.location.href = '{{route('home')}}';
                            }
                        });
                    },
                    error: function (xhr) {
                        button.attr('disabled', null).html(previous);
                        erroralert(xhr);
                    }
                });

            });

        });
    </script>


@endsection