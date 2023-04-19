<form id="register-form" enctype="multipart/form-data">
    @csrf
    <div class="form-box text-center ambassador-div">
        <div class="form-sub-title text-center">
            <p class="mb-3"><b>Profile Picture</b></p>
        </div>
        <div class="upload-profile-div">
            <div class="upload-profile-div-inner text-center">
                <div class="upload-profile-image-div">
                    <img src="{{asset('main-assets/images/default/user.png')}}" alt=""
                         id="user-image">
                    <div class="camera-icon choose-pic-trigger " data-user="ambassador">
                        <img src="{{asset('main-assets/images/icons/camera.png')}}" alt=""></div>
                    <input type="file" id="choose-pic-input" class=" d-none" name="profile">

                </div>
                <div class="small-text text-center"
                     style="   font-size: 10px;    margin-top: 10px !important;    margin: 0 auto;    width: 126px;    border-radius: 4px;    background-color: #efefef;">
                    <i style="font-style: italic;">*Max image size is 10MB</i>
                </div>
            </div>
        </div>
        <div class="form-field-grid">
            <div class="single-field">
                <div class="form-field">
                    <label class="d-flex" style="justify-content: space-between">
                        <span>Email Address</span>
                    </label>
                    <input type="email" class="form-field-input form-control" placeholder='Email Address' name="email" id="email" autocomplete="off">
                    <small id="verify-email" class="float-right text-primary">
                        <u>
                            Verify Email
                        </u>
                    </small>
                </div>
            </div>
            <div class="single-field">
                <label>Mobile Number</label>
                <div class="phone-number-field">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">+1</span>
                        </div>
                        <input type="number" class="form-control"
                               placeholder='Mobile Number' name="phone" id="phone" autocomplete="off">

                    </div>
                </div>
                <small style="visibility: hidden">
                    Dummy
                </small>
            </div>
            <input type="hidden" value="" name="country_code" id="country_code">
            <div class="single-field">
                <label>First Name</label>
                <div class="form-field">
                    <input type="text" class="form-field-input form-control"
                           placeholder='First Name' name="fname" id="fname" autocomplete="off">

                </div>
            </div>
            <div class="single-field">
                <label>Last Name</label>
                <div class="form-field">
                    <input type="text" class="form-field-input form-control"
                           placeholder='Last Name' name="lname" id="lname" autocomplete="off">
                </div>
            </div>
            <div class="single-field">
                <label>Username</label>
                <div class="form-field">
                    <input type="text" class="form-field-input form-control"
                           placeholder='Username' name="username" autocomplete="off" id="username">
                </div>
                <div class="small-text text-left" style="    font-size: 10px;">
                    <i>*Username must not contain space or special character.</i>
                </div>
            </div>

            <div class="single-field">
                <label>Gender</label>
                <div class="form-field">
                    <select name="gender" id="gender" class='form-field-input form-control'>
                        <option value="" hidden>Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="small-text text-left" style="    font-size: 10px; opacity:0">
                    <i>*Username must not contain space or special character.</i>
                </div>
            </div>
            <div class="single-field">
                <label>NPI Number</label>
                <div class="form-field">
                    <input type="text" class="form-field-input form-control"
                           placeholder='NPI Number' name="npi" id="npi" autocomplete="off">
                </div>
            </div>
            <div class="single-field">
                <label>Date of Birth</label>
                <div class="form-field">
                    <input type="date" class="form-field-input form-control"
                           placeholder='dob' name="dob" id="dob">
                </div>
            </div>
            <div class="single-field">
                <label>Password</label>
                <div class="form-field has-icon">
                    <input type="password"
                           class="form-field-input form-control hidden-password"
                           placeholder='Password' name="password" >
                    <span class="eye-icon show-password" data-target='.hidden-password'><i
                                class="fa fa-eye" aria-hidden="true"></i></span>
                </div>
            </div>
            <div class="single-field">
                <label>Confirm Password</label>
                <div class="form-field">
                    <input type="password" class="form-field-input form-control hidden-password" placeholder='Confirm Password' name="password_confirmation">
                </div>
            </div>
        </div>
        <div class="form-info-text">
            <div class="small-text text-left">
                <i>*Password must be at least 8 characters long.</i>
            </div>
        </div>
        <div class="form-action-button justify-content-start">
            <button class="custom-black-btn" type="submit" id="register-btn" disabled="disabled">Sign Up</button>
        </div>
        <div class="form-bottom-link text-left mt-2 small-text">
            <i>Already have an account?</i> <a href="{{url('login')}}">Log In</a>
        </div>
    </div>
</form>
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
<script>
    $(function () {
        $(document).on('click', '.choose-pic-trigger', function () {
            $("#choose-pic-input").trigger('click');
        });
        $(document).on('change', '#choose-pic-input', function () {
            if (this.files[0].size > 10000000) {
                $.toast({
                    heading: 'Error',
                    text: 'The Profile Picture must be less than 10MB.*',
                    icon: 'warning',
                    position: 'top-right'
                });
            } else {
                document.getElementById('user-image').src = window.URL.createObjectURL(this.files[0]);
            }
        });
    });
</script>