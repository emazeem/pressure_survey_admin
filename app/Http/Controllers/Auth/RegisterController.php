<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\ChartOfAccount;
use App\Http\Traits\Transaction;
use App\Models\AdvertiserDetail;
use App\Models\UserDetail;
use App\Models\Post;
use App\Models\PostAssets;
use App\Models\Referral;
use App\Models\Role;
use App\Models\UserAsset;
use App\Models\MerchantDetails;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Nexmo;

class RegisterController extends Controller
{

    use RegistersUsers;
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        ini_set('upload_max_filesize','20MB');
        return Validator::make($data, [
            'business_name' => ['required', 'string', 'max:255'],
            'npi' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'contact_fname' => ['required', 'string', 'max:255'],
            'contact_lname' => ['required', 'string', 'max:255'],
            'contact_email' => ['required', 'string', 'max:255'],
            'contact_phone' => ['required', 'string', 'max:255'],
            'attachment_type' => ['required', 'string', 'max:255'],
            'attachment' => ['required', 'max:10240','image'],

            'profile' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:10240'],
        ],[
            /*'npi.required' => 'NPI Number is required.',
            'dob.required' => 'Date of birth is required.',
            'gender.required' => 'Gender is required.',
            'password.required' => 'Password is required.',
            'username.required' => 'Username is required.',
            'phone.required' => 'Phone is required.',
            'email.required' => 'Email is required.',
            'fname.required' => 'First name is required.',
            'lname.required' => 'Last name is required.',
            'country_code.required' => 'Country code is required.',
            'profile.required' => 'Profile Picture is required.',
            'profile.max' => 'The Profile Picture must not be greater than 10MB.',*/
        ]);
    }


    protected function create(array $data)
    {
        $email_code = rand(100000,999999);
        $profile = imageResize($data['profile'], 'storage/profile/' . $data['email'] . '/');
        $user = new User();
        $user->fname = $data['business_name'];
        $user->lname = $data['business_name'];
        $user->role = $data['role'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->gender = "male";
        $user->username = explode('@',$data['email'])[0];
        $user->password = Hash::make($data['password']);
        $user->profile = $profile;
        $user->email_code = $email_code;
        $user->save();

        $details = new AdvertiserDetail();
        $details->city=$data['city'];
        $details->state=$data['state'];
        $details->country=$data['country'];
        $details->address=$data['address'];

        $attachment = imageResize($data['attachment'], 'storage/advertiser-attachment/');
        $details->user_id=$user->id;
        $details->contact_fname=$data['contact_fname'];
        $details->contact_lname=$data['contact_lname'];
        $details->contact_email=$data['contact_email'];
        $details->contact_phone=$data['contact_phone'];
        $details->npi=$data['npi'];
        $details->attachment_type=$data['attachment_type'];
        $details->attachment=$attachment;
        $details->save();
        //$user->profilePicturePost($attachment, $data['profile']);
        $email = $data['email'];
        $lname = $data['contact_fname'];
        $fname = $data['contact_lname'];
        $from='connectsocial@napollo.net';
        session()->put("verify_email_code",$email_code);
        sendEmail($email, $from, 'Connect Social', registerEmailTextRegister($lname, $fname, $email_code));
        return $user;
    }
}
