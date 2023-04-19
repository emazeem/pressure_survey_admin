<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\CommonTrait;
use App\Models\UserDetail;
use App\Models\AmbassadorPrivacy;
use App\Models\User;
use Illuminate\Http\Request;

class PrivacyManagementController extends Controller
{
    use CommonTrait;
    //
    public function fetch(Request $request){
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $columns=['email','phone','gender','fax','about','city','state','country','joining','workplace','university','hobbies',];

        $privacy = array();
        foreach ($columns as $column) {
            $privacies=AmbassadorPrivacy::where('user_id',$request->id)->where('column',str_replace('_','-',$column))->first();
            if(!$privacies){
                $privacy[$column]='public';
            }else{
                $privacy[$column]=$privacies->privacy;
            }
        }

        return $this->sendSuccess("Privacy Fetched Successfully.",$privacy);

    }
    public function update_privacy(Request $request){
        $validators = Validator($request->all(), [
            'id' => 'required',
            'column' => 'required',
            'privacies' => 'required',

        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $alreadyExist=AmbassadorPrivacy::where('user_id',$request->id)->where('column',$request->column)->first();
        if ($alreadyExist){
            $newPrivacy=$alreadyExist;
        }else{
            $newPrivacy=new AmbassadorPrivacy();
        }

        $newPrivacy->user_id = $request->id;
        $newPrivacy->column = $request->column;
        $newPrivacy->privacy = trim($request->privacies);
        $newPrivacy->save();

        return $this->sendSuccess("Privacy Updated Successfully.",true);

    }


    public function check_privacy_of_user(Request $request) {
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $columns=[
            'about','city','state','country',
            'joining','workplace','university','hobbies',
            'email','phone','gender','fax'];
        $showPrivacy = array();
        foreach ($columns as $column){
            if ($request->id == auth()->user()->id){
                $showPrivacy[$column] = true;
            }
            else{
                $showPrivacy[$column] = visibleSocialInfoToUser($request->id, str_replace('_','-',$column));
            }

        }
        return $this->sendSuccess("Privacy checked for user.",$showPrivacy);


    }
}
