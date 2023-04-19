<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\CommonTrait;
use App\Models\UserDetail;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    //
    use CommonTrait;
    public function fetch(){
        $approvedSpecialities=Speciality::where('status',1)->get();
        return $this->sendSuccess("All approved specialities",$approvedSpecialities);
    }
    public function update(Request  $request){
        $validators = Validator($request->all(), [
            'id' => 'required',
            'speciality' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        if ($request->speciality==0){
            $speciality=new Speciality();
            $speciality->title=$request->title;
            $speciality->save();
        }
        $user=User::find($request->id);
        $userDetails=UserDetail::find($user->details->id);
        $userDetails->speciality_id=$request->speciality==0?$speciality->id:$request->speciality;
        $userDetails->save();

        return $this->sendSuccess("Speciality updated",true);
    }

}
