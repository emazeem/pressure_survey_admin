<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\CommonTrait;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{

    use CommonTrait;
    public function pending(Request $request){
        $nots = Auth::user()->unreadNotifications->count();
        $data['unread-notifications']=$nots;
        return $this->sendSuccess("Unread notifications",$data);
    }
    public function markAsRead(Request $request){
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        DB::table('notifications')->where('id',$request->id)->where('read_at',null)->update(['read_at' => date("Y-m-d H:i:s", time())]);
        $response['success']=true;
        return $this->sendSuccess("Unread notifications",$response);
    }
    public function allMarkAsRead(Request $request){
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        DB::table('notifications')->where('notifiable_id',$request->id)->where('read_at',null)->update(['read_at' => date("Y-m-d H:i:s", time())]);
        $response['success']=true;
        return $this->sendSuccess("Unread notifications",$response);
    }


    public function Notification(Request $request){
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $nots = Auth::user()->notifications;
        $notifications=[];
        foreach ($nots as $not){
            $notifications[]=[
              'id'=>$not->id,
              'msg'=>substr(strip_tags($not->data['msg']),0,110),
              'url'=>$not->data['url'],
              'read_at'=>$not->read_at,
              'created_at'=>dateBreaks($not->created_at),
              'from'=>User::where('id',$not->data['from'])->select(['id','fname','lname','email','profile'])->first(),
            ];
        }
        $data['notifications']=$notifications;
        return $this->sendSuccess("Notifications fetch successfully",$data);
    }
}
