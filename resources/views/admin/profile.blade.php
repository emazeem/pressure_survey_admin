@extends("layouts.master")
@section("style")
@endsection

@section("wrapper")
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">User Profile</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!--end breadcrumb-->
            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <img src="{{auth()->user()->profile_image()}}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                                        <div class="mt-3">
                                            <h4>{{auth()->user()->fullName()}}</h4>
                                            <p class="text-secondary mb-1">{{auth()->user()->fname}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{route('users.update.profile')}}" id="change_profile_form">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <input type="file" onchange="document.getElementById('user-image').src = window.URL.createObjectURL(this.files[0])" id="choose-pic-input" class='d-none' name="profile">
                                                <center>
                                                    <div class="upload-profile-div" style="position: relative;width: 200px">
                                                        <img src="{{auth()->user()->profile_image()}}" alt="" id="user-image">
                                                        <div class="camera-icon" id="choose-pic-trigger"><img src="{{url('assets/images/icons/camera.png')}}" alt="" style="right:25px;bottom: 15px;position: absolute"></div>
                                                    </div>

                                                </center>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">First Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" disabled class="form-control" value="{{auth()->user()->fname}}" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Last Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" disabled class="form-control" value="{{auth()->user()->lname}}" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" disabled class="form-control" value="{{auth()->user()->email}}" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Username</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" disabled class="form-control" value="{{auth()->user()->username}}" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Phone</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" disabled class="form-control" value="{{auth()->user()->country_code.auth()->user()->phone}}" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Gender</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <select class="form-control" disabled>
                                                    <option value="male"   {{auth()->user()->gender=='male'?'selected':''}}>Male</option>
                                                    <option value="female" {{auth()->user()->gender=='female'?'selected':''}}>Female</option>
                                                </select>

                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9">
                                                <input type="submit" class="btn btn-primary px-3" value="Save Changes" />
                                            </div>
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
    <style>

        #user-image {
            width: 142px;
            height: 142px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
@endsection

@section("script")
    <script>
        $('#choose-pic-trigger').click(function () {
            $("#choose-pic-input").trigger('click');
        });
        $(function () {
            $(document).on('submit','#change_profile_form',function (e) {
                e.preventDefault();
                var route = '{{route('users.update.profile')}}';
                var method = 'POST';
                var data = new FormData(this);
                var next = {'type':'reload'};
                submit($(this).find('button[type=submit]'),method,route,data,next);
            });
        });
    </script>
@endsection
