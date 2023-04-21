<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class VerifyCodeController extends Controller
{
    //
    public function resend_code(Request $request){

        $emailcode=rand(100000,999999);
        $message='<h6>Email Verification:</h6>
Dear '.auth()->user()->fullName().',<br>
Congrats! You are one step away to be our part!<br>
You need to verify your email address to activate your account. Please use the following 6-digit One Time Password (OTP) to complete your sign-up procedure. <br>
'.$emailcode.'<br>
Do not provide this code to anyone else to keep your important data confidential. If you are receiving this email without registering, contact us.<br>
For any help, seek our assistance at abcdef@gmail.com.<br>
With Best Regards,<br>
NP Social';
        sendEmail(auth()->user()->email,'connectsocial@napollo.net','Almost There! Confirm Your Email',$message);
        $user = User::find(auth()->user()->id);
        $user->email_code = $emailcode;
        $user->save();

        return response()->json(['success' => 'Another verification code has been sent to your email.!']);

    }
    public function verify_code(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|digits:6|integer'
        ]);
        if (!auth()->user()->email_verified_at) {
            if ($request->code == auth()->user()->email_code) {
                $user = User::find(auth()->user()->id);
                $user->email_verified_at = date('Y-m-d H:i:s');
                $user->save();
                return response()->json(['success' => 'Your email address is verified successfully.!']);
            } else {
                $response['message'] = ['Invalid OTP !'];
                return response()->json([
                    'status' => 'failed',
                    'status_code' => 422,
                    'errors' => $response,
                ], 422);
            }
        } else {
            $response['message'] = ['Email already verified !'];
            return response()->json([
                'status' => 'failed',
                'status_code' => 422,
                'errors' => $response,
            ], 422);
        }
    }
    public function sendMailRegister(Request $request){

        
        $phoneDuplicate = User::select(['country_code', 'phone'])->where('country_code', $request->country_code)->where('phone', $request->phone)->get()->count();
        if ($phoneDuplicate>0){
            throw ValidationException::withMessages(['phone'=>'Phone number has already been taken.']);
        }
        $request->validate([
            'email' => 'required|email|unique:users|max:30',
            'phone' => 'required|min:2|max:22',
            'lname' => 'required|min:2|max:22',
            'fname' => 'required|min:2|max:22',
            'username' => 'required|min:2|max:22|unique:users|regex:/(^[a-zA-Z]+[a-zA-Z0-9\\-]*$)/u',
            'gender' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);

            $email = $request->email;
            $lname = $request->lname;
            $fname = $request->fname;
            $from='connectsocial@napollo.net';
            $email_code = rand(100000,999999);

            session()->put("verify_email_code",$email_code);
            sendEmail($email, $from, 'Connect Social', registerEmailTextRegister($lname, $fname, $email_code));

            return  response()->json(['success'=> 'Email send successfully.']);

    }
}