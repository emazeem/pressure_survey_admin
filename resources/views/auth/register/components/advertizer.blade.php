<style>
.cursor-pointer{
    cursor: pointer;
}

</style>
<form id="register-avertizer-form" enctype="multipart/form-data">
    @csrf
    @method('POST')

    <input type="hidden" value="{{$role}}" name="role">
    {{-- <input type="hidden" value="{{$by}}" name="referred_by"> --}}

    <div class="form-box">
        <div class="form-sub-title text-center">
            <h4 class="mb-2 mt-3"><b>Sign Up | As Advertiser</b></h4>
        </div>
        <div class="form-sub-title text-center">
            <p class="mb-2"><b>Profile Picture</b></p>
        </div>

        <div class="upload-profile-div">
            <div class="upload-profile-div-inner text-center">
                <div class="upload-profile-image-div">
                    <img src="{{asset('main-assets/images/default/user.png')}}" alt="" id="user-image">
                    <div class="camera-icon choose-pic-trigger cursor-pointer " data-user="advertizer">
                        <img src="{{asset('main-assets/images/icons/camera.png')}}" alt="" >
                    </div>
                    <input type="file" id="choose-pic-input" name="profile" style="display: none" >
                </div>
                <div class="small-text"
                     style="   font-size: 10px;    margin-top: 10px !important;    margin: 0 auto;    width: 126px;    border-radius: 4px;    background-color: #efefef;">
                    <i style="font-style: italic;">*Max image size is 10MB</i>
                </div>
            </div>
        </div> 
        <h4>Business Information</h4>
        <hr style="width:35%">
        <div class="row">
            <div class="col-md-6 pb-2">
                <label id="business_name">Business Name</label>
                <div class="input-group mb-2">
                    <input type="text" class="input-group-input form-control" placeholder='Business Name' name="business_name" id="business_name" required>
                </div>
            </div>
            <div class="col-md-6 pb-2">
                <label id="npi">Npi</label>
                <div class="input-group mb-2">
                    <input type="number" class="input-group-input form-control" placeholder='Npi' name="npi" required>
                </div>
            </div>

            <div class="col-md-6 pb-2">
                    <label>Business Email</label>
                    <div class="input-group">
                    <input type="email" class="input-group-input form-control"
                           placeholder='Business Email' name="email" id="email" required autocomplete="off">
                    </div>
            </div>
            <div class="col-md-6 pb-2">
                <label>Mobile Number</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">+1</span>
                    </div>
                    <input type="number" style="width: 100%;" name="phone" id="phone"
                    class="form-div-field-input form-control" placeholder="xxxxxxxxxxx">
                  </div>
                    <input type="hidden" name="country_code" value="+1" >
            </div>
            <div class="col-md-6">
                <label>Password</label>
                <div class="input-group mb-2">
                    <input type="password" class="input-group-input form-control hidden-password"
                           placeholder='Password' name="password" id="password"  aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <span class="input-group-text" id="basic-addon2"> <span class="eye-icon show-password" data-target='.hidden-password'><i class="fa fa-eye"
                                                                                                                                               aria-hidden="true"></i></span></span>
                    </div>
                </div>
                <div class="form-info-text">
                    <div class="small-text text-left" style="    font-size: 10px;">
                        <i>*Password must be at least 8 characters long.</i>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label>Confirm Password</label>
                <div class="input-group">
                    <input type="password" class="input-group-input form-control hidden-password"
                           placeholder='Confirm Password' name="password_confirmation" id="password_confirmation" required>
                </div>
            </div>
            <div class="form-info-text">
                <div class="small-text text-left" style="    font-size: 10px;">
                    <i>*Password must be at least 8 characters long.</i>
                </div>
            </div>
            <div class="col-md-6">
                <label>City</label>
                <div class="input-group mb-2">
                    <input type="text" class="input-group-input form-control" placeholder='City' name="city"  required>
                </div>
            </div>
            <div class="col-md-6">
                <label>State</label>
                <div class="input-group mb-2">
                    <input type="text" class="input-group-input form-control" placeholder='State' name="state" required>
                </div>
            </div>
            <div class="col-md-6 pb-2">
                <label>Country</label>
                <div class="input-group mb-2">
                    <input type="text" class="input-group-input form-control" placeholder='Country' name="country" required>
                </div>
            </div>
            <div class="col-md-6">
                <label id="address">Business Address</label>
                <div class="input-group mb-2">
                    <textarea class="form-control" placeholder='Business Address' name="address"></textarea>
                </div>
            </div>

            <div>
            <h4 class="pt-4">Contact Information</h4>
            <hr style="width:35%">
            </div>
            <div class="col-md-6">
                <label id="contact_fname">First Name</label>
                <div class="input-group mb-2">
                    <input type="text" class="input-group-input form-control"
                           placeholder='First Name' name="contact_fname" id="contact_fname" required>

                </div>
            </div>
            <div class="col-md-6">
                <label id="contact_lname">Last Name</label>
                <div class="input-group">
                    <input type="text" class="input-group-input form-control"
                           placeholder='Last Name' name="contact_lname" id="contact_lname" required>
                </div>
            </div>
            <div class="col-md-6">
                <label id="contact_email">Email</label>
                <div class="input-group">
                    <input type="text" class="input-group-input form-control"
                           placeholder='Contact person email' name="contact_email" required>
                </div>
            </div>
            <div class="col-md-6">
                <label id="contact_phone">Mobile Number</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">+1</span>
                    </div>
                    <input type="number" style="width: 100%;" name="contact_phone" id="contact_phone"
                    class="form-div-field-input form-control" >
                  </div>
                    <input type="hidden" name="country_code" value="+1" >
            </div>
            <div>
                <h4 class="pt-4">Attachments</h4>
                <hr style="width:35%">
            </div>
            <div class="col-md-6 pb-2">
                <label id="attachment_type">Attachment</label>
                <div class="input-group">
                    <select type="text" class="input-group-input form-control" name="attachment_type">
                        <option selected disabled hidden>-- Select an option</option>
                        <option value="Driving License">Driving License</option>
                        <option value="Passport">Passport</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 pb-2">
                <label id="attachment">Attachment</label>
                <div class="input-group">
                    <input type="file" name="attachment" class="form-control" required>
                </div>
            </div>



        </div>

        <div class="form-action-button justify-content-start pt-2">
            <button class="custom-black-btn btn btn-dark" type="submit" id="register-button">Sign Up</button>
        </div>
        <div class="form-bottom-link text-left mt-2 small-text pb-3">
            <i>Already have an account?</i> <a href="{{url('login')}}">Log In</a>
        </div>
    </div>
</form>
@push('scripts')
    <script>
        $(document).on('click','.choose-pic-trigger',function(){
            $('#choose-pic-input').click();
        })
        $(function () {
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
            $(document).on('change', '#choose-pic-input', function () {
                /*var filePath = $(this).val();
                var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                var imageSize = (this.files[0].size / 1024000).toFixed(2);

                if (!allowedExtensions.exec(filePath)) {
                    $.toast({
                        heading: 'Error',
                        text: 'Profile picture format not supported.*',
                        icon: 'warning',
                        position: 'top-right'
                    });
                    $('#choose-pic-input').val('');
                    $('#user-image').attr('src', '{{asset('main-assets/images/default/user.png')}}');
                    recreateCanvas('canvas');

                } else if (imageSize >= 10) {
                    $.toast({
                        heading: 'Error',
                        text: 'The Profile Picture must be less than 10MB.*',
                        icon: 'warning',
                        position: 'top-right'
                    });
                    $('#choose-pic-input').val('');
                    $('#user-image').attr('src', '{{asset('main-assets/images/default/user.png')}}');
                    recreateCanvas('canvas');

                } else {
                    generate_canvas('canvas');
                    document.getElementById('user-image').src = window.URL.createObjectURL(this.files[0]);
                }*/


                var fp = $(this);
                var filePath = fp.val();
                var height = 0, width = 0;
                var items = fp[0].files;
                var src = window.URL.createObjectURL(this.files[0]);
                var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                var fileSize = items[0].size; // get file size

                if (allowedExtensions.exec(filePath)) {
                    var reader = new FileReader();
                    reader.readAsDataURL(fp[0].files[0]);
                    reader.onload = function (e) {
                        var image = new Image();
                        image.src = e.target.result;
                        image.onload = function () {
                            height = this.height;
                            width = this.width;
                        };
                    };
                    setTimeout(function () {
                        if (fileSize > (1048576 * 10)) {
                            $.toast({
                                heading: 'Error',
                                text: 'Profile photo must be less than 10MB.*',
                                icon: 'warning',
                                position: 'top-right'
                            });
                            fp.val('');
                            $('.click-trigger.' + id).attr('src', defaultAttachmentImage);

                        }else if (width>10000 || height>10000){
                            $.toast({
                                heading: 'Error',
                                text: 'Profile photo format not supported.*',
                                icon: 'warning',
                                position: 'top-right'
                            });
                            $('#choose-pic-input').val('');
                            $('#user-image').attr('src', '{{asset('main-assets/images/default/user.png')}}');

                        }else {
                            document.getElementById('user-image').src =src;
                        }
                    },1000);

                }else{
                    $.toast({
                        heading: 'Error',
                        text: 'Profile photo must be of type jpg, jpeg or png.*',
                        icon: 'warning',
                        position: 'top-right'
                    });
                    $('#choose-pic-input').val('');
                    $('#user-image').attr('src', '{{asset('main-assets/images/default/user.png')}}');
                }

            });
        });

    </script>
@endpush
