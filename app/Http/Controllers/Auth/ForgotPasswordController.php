<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{

    use SendsPasswordResetEmails;
    public function change_password(Request $request){
        $this->validate($request,[
           'password'=>'required|min:8|confirmed'
        ]);
        $user = User::find($request->id);
        if ($request->verification!=$user->email_token){
            $response['message']=['Your link is expired.'];
            return response()->json([
                'status'      => 'failed',
                'status_code' => 422,
                'errors'     => $response,
            ], 422);
        }else{
            $user->password=Hash::make($request->password);
            $user->email_token=null;
            $user->save();
            return response()->json(['success'=>'Password is changed successfully!']);
        }
    }
    public function create_new_password($id,$token){
        $user=User::find($id);
        $account=false;
        $tokenverify=false;
        if ($user){
            $account=true;
            if ($user->email_token==$token){
                $account=true;
                $tokenverify=true;
            }
        }
        return view('auth.passwords.create-new-password',compact('account','tokenverify','user','token'));
    }

    public function send_email(Request $request){
        $this->validate($request,['email'=>'required|max:50']);
        $user = User::where('email',$request->email)->first();
        if ($user){
            $user->email_token=Crypt::encryptString(time());
            $user->save();
            $message='Hello '.$user->fullName().',<br>
You recently requested for a password reset for your NP Social account. Click on the below link or open the link in your browser to reset your password;<br>
We recommend setting a unique password that you don’t use for other sites. For any further assistance, do not hesitate to contact us at abc@gmail.com.<br>
'.url('create-new-password/'.$user->id.'/'.$user->email_token).'<br>
Thanks<br>
NP Social
';
            sendEmail($request->email,null,'Password Reset Link',$message);
        }
        $email=$request->email;
        $request->session()->flash('successMsg','If the email entered is associated with a NP Social account, you will receive an email with password reset instructions.');
        return view('auth.passwords.resend',compact('email'));
    }
}
