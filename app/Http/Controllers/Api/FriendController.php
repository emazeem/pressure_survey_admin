<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\CommonTrait;
use App\Models\Block;
use App\Models\Chat;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    use CommonTrait;

    public function friend(Request $request)
    {
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        //$userdata = getFriendsListUsers($request->id);
        $blockedUsersId=allBlockList();
        $friends=Friend::select('id','from','to','status')->whereNotIn('from',$blockedUsersId)->whereNotIn('to',$blockedUsersId)->where('from',$request->id)->where('status',\Friends::STATUS_APPROVED)->orwhere('to',$request->id)->where('status',\Friends::STATUS_APPROVED)->get();
        $users=[];
        foreach ($friends as $friend){
            if ($request->id==$friend->from){
                $user=$friend->user_to;
            }
            if ($request->id==$friend->to){
                $user=$friend->user_from;
            }
            $user['unread']=$user->unread_messages($user->id);
            if(!isUserBlocked($user->id)){
                $users[]=$user;
            }
        }
        $userdata=$users;
        $data['friends'] = $userdata;
        return $this->sendSuccess("Fetch all Friend!", $data);
    }
    public function marketplace(Request $request)
    {
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $chats=Chat::where('type','marketplace')->where('from',$request->id)->orwhere('to',$request->id)->where('type','marketplace')->get();
        $markeplaceUserId=[];
        foreach ($chats as $chat){
            if($request->id!=$chat->from){
                $markeplaceUserId[]=$chat->from;
            }
            if($request->id!=$chat->to){
                $markeplaceUserId[]=$chat->to;
            }
        }
        $markeplaceUserId=array_values(array_unique($markeplaceUserId));
        $users=[];
        foreach (User::select('id','fname','lname','profile','email','role')->whereIn('id',$markeplaceUserId)->where('id','!=',$request->id)->where('role',3)->get() as $user){
            if(!isUserBlocked($user->id)){
                $user['unread']=$user->unread_messages($user->id);
                $users[]=$user;
            }
        }
        $data['friends'] = $users;
        return $this->sendSuccess("Fetch all marketplace friends!", $data);
    }

    public function send_request(Request $request)
    {
        $validators = Validator($request->all(), [
            'to' => 'required',
            'from' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        if (Friend::where('from', $request->from)->where('to', $request->to)->get()->count() == 0) {
            $friends = new Friend();
            $friends->from = $request->from;
            $friends->to = $request->to;
            $friends->save();
        }
        $requested_to = User::where('id',$request->to)->first();
        a_notification($request->to,'<b>'.auth()->user()->fullName().'</b> sent you a friend request.',['url'=>'friend','data'=>(int)auth()->user()->id]);

        $data['success'] = true;
        return $this->sendSuccess("Friend request sent", $data);
    }

    public function cancel_request(Request $request)
    {
        $validators = Validator($request->all(), [
            'to' => 'required',
            'from' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $req = Friend::where('from', $request->from)->where('to', $request->to)->where('status', 0)->first();
        $req->delete();
        $data['success'] = true;
        return $this->sendSuccess("User unfriend successfully!", $data);

    }

    public function remove_friend(Request $request)
    {
        $validators = Validator($request->all(), [
            'from' => 'required',
            'to' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $req = Friend::where('from', $request->from)->where('to', $request->to)->where('status', 1)->first();
        if ($req) {
            $req->delete();
        }
        $req = Friend::where('to', $request->from)->where('from', $request->to)->where('status', 1)->first();
        if ($req) {
            $req->delete();
        }
        $data['success'] = true;
        return $this->sendSuccess("User is remove from friend list", $data);

    }

    public function accept_reject(Request $request)
    {
        // 1 accept 2 reject
        $validators = Validator($request->all(), [
            'id' => 'required',
            'auth_id' => 'required',
            'status' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $action = Friend::where('to', $request->auth_id)->where('from', $request->id)->first();
        if ($request->status == 1) {
            $action->status = $request->status;
            $action->save();
            $accepted_from = User::find($request->auth_id);
            a_notification($request->id,'<b>'.$accepted_from->fullName().'</b> accepted your friend request.',['url'=>'friend','data'=>(int)$request->auth_id]);
            $message='Friend request accepted';
        } else {
            $action = Friend::where('to', $request->auth_id)->where('from', $request->id)->orwhere('from', $request->auth_id)->where('to', $request->id)->first();
            $action->delete();
            $message='Friend request rejected';
        }
        $data['success'] = true;
        return $this->sendSuccess($message, $data);
    }

    public function status(Request $request){
        $validators = Validator($request->all(), [
            'auth_user' => 'required',
            'other_user' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }

        $status=[];
        $status['requested']=false;
        $status['sent_from']=null;
        $status['is_friend']=false;
        $req = Friend::select('id','from','to','status')->where('from', $request->auth_user)->where('to', $request->other_user)->orwhere('to', $request->auth_user)->where('from', $request->other_user)->first();
        if ($req) {
            $status['requested']=true;
            if($req->status==0){
                if($req->from==$request->auth_user){
                    $status['sent_from']=$request->auth_user;
                }else{
                    $status['sent_from']=$request->other_user;
                }
                $req['is_friend']=false;
            }else{
                $req['is_friend']=true;
            }
        }else{
            $status['requested']=false;
        }
        $status['friend']=$req;
        return $this->sendSuccess('Friend status', $status);
    }

    public function pendingRequests(Request $request){
        $count = Friend::select('id','from','to','status')->where('to', $request->id)->where('status',\Friends::STATUS_REQUEST_SENT)->get()->count();
        return $this->sendSuccess('Friend requests', $count);
    }
    public function friend_request(Request $request)
    {
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $blockedUsersId=[];
        foreach (Block::where('from',\auth()->user()->id)->orwhere('to',\auth()->user()->id)->get() as $blockUser){
            if($blockUser->from==auth()->user()->id){
                $blockedUsersId[]=$blockUser->to;
            }
            if($blockUser->to==auth()->user()->id){
                $blockedUsersId[]=$blockUser->from;
            }
        }
        $userdata = Friend::select('id','from','to','status')->with(['user_from' => function ($query) {
            $query->select('id','fname','lname','profile','email');
        }])->whereNotIn('user_id',$blockedUsersId)->where('to',$request->id)->where('status',\Friends::STATUS_REQUEST_SENT)->get();
        // $userdata = Friend::leftJoin('users','friends.from','=','users.id')->select('friends.id','friends.from','friends.to','friends.status','users.id','users.fname','users.lname','users.email','users.profile')->where('to',$request->id)->where('status',\Friends::STATUS_REQUEST_SENT)->get();
        $data['friend_request'] = $userdata;
        return $this->sendSuccess("Fetch pending requests!", $data);
    }

}
