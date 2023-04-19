<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use App\Http\Traits\CommonTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class RegisterController extends Controller
{
    use CommonTrait;
    function register(Request $request)
    {
        $validators = Validator($request->all(), [
            'phone' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required',
            'gender' => 'required',
            'npi' => 'required|unique:user_details',
            'dob' => 'required',
            'country_code'=>'required',
            'role'=>'required'
        ],[
            'unique'=> 'This :attribute already exists',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
            if( $request->password == $request->confirm_password){
            $userdata = new User();
            $userdata->fname = $request->fname;
            $userdata->lname = $request->lname;
            $userdata->email = $request->email;
            $userdata->phone = $request->phone;
            $userdata->username = $request->username;
            $userdata->role = 3;
            $userdata->gender = $request->gender;
            $userdata->country_code = $request->country_code;
            $userdata->password = Hash::make($request->password);
            if($request->hasfile('profile')){
                $file = $request->file('profile');
                $extenstion = $file->getClientOriginalExtension();
                $filename = time().'.'.$extenstion;
                $file->move('storage/profile/'.$request->email, $filename);
                $userdata->profile = $filename;
            }
            $userdata->save();
            if(UserDetail::where('user_id',$userdata->id)->get()->count()==0){
                $ambassadordetail = new UserDetail;
                $ambassadordetail->npi = $request->npi;
                $ambassadordetail->user_id = $userdata->id;
                $ambassadordetail->date_of_birth =$request->dob;
                $ambassadordetail->joining =date('Y-m-d');
                $ambassadordetail->save();
            }
            if ($userdata) {
                $data['data']=$userdata;

                $data['token'] = $userdata->createToken('auth-token')->plainTextToken;

                return $this->sendSuccess("Successfully Registered!",$data);

            } else {
                return $this->sendError("Not Registered!", null);
            }
        }
        else{
            return $this->sendError("These credentials do not match our records.", null);
        }

    }
    function verify_email(Request $request)
    {

        $validators = Validator($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|unique:users',
            'code' => 'required',
        ],[
            'unique'=> 'This :attribute already exists',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }

        $message='<h6>Email Verification:</h6>
Dear '.($request['fname'].' '.$request['lname']).',<br>
Congrats! You are one step away to be our part!<br>
You need to verify your email address to activate your account. Please use the following 6-digit One Time Password (OTP) to complete your sign-up procedure. <br>
'.$request['code'].'<br>
Do not provide this code to anyone else to keep your important data confidential. If you are receiving this email without registering, contact us.<br>
For any help, seek our assistance at abcdef@gmail.com.<br>
With Best Regards,<br>
NP Social';
        if(sendEmail($request->email,'connectsocial@napollo.net','Almost There! Confirm Your Email',$message)){
            $data['success']=true;
            return $this->sendSuccess("6 Digit OTP is sent to your email address (".$request['email'].")",$data);

        }else{
            $data['success']=false;
            return $this->sendError("OTP email sending error. Please try again.", $data);
        }
    }

}
