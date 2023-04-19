<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Traits\ChartOfAccount;
use App\Http\Traits\Transaction;

class ProcessingController extends Controller
{
    public function send_verification_email(Request $request){
        $code=['email'=>$request->email,'code'=>rand(100000,999999),'status'=>'pending'];
        $message=registerEmailText($code['code']);
        sendEmail($request->email, 'connectsocial@napollo.net', 'Almost There! Confirm Your Email', $message);
        session()->put('verify_email_code',$code);
        $code = session()->get('verify_email_code');
        return response()->json(['success'=>true,'code'=>$code['code']]);
    }
    public function email_verification(Request $request){
        $this->validate($request,[
           'code'=>'required'
        ]);
        $code = session()->get('verify_email_code');
        if ($code['code']==$request->code){
            if ($code['email']==$request->email){
                $code['status']='verified';
                session()->put('verify_email_code',$code);
                return response()->json(['success'=>true,'email'=>$request->email]);
            }
        }
        return response()->json(['success'=>false]);
    }
}
