<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\CommonTrait;
use App\Models\License;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    //
    use CommonTrait;
    public function store(Request  $request){
        $validators = Validator($request->all(), [
            'auth_id' => 'required',
            'title' => 'required',
            'number' => 'required',
            'expiry' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), false);
        }
        $license=new License();
        $license->user_id=$request->auth_id;
        $license->title=$request->title;
        $license->number=$request->number;
        $license->expiry=$request->expiry;
        $license->save();
        return $this->sendSuccess("License added successfully!",true);
    }
    public function update(Request  $request){
        $validators = Validator($request->all(), [
            'id' => 'required',
            'title' => 'required',
            'number' => 'required',
            'expiry' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), false);
        }
        $license=License::find($request->id);
        $license->title=$request->title;
        $license->number=$request->number;
        $license->expiry=$request->expiry;
        $license->save();
        return $this->sendSuccess("License updated successfully!",true);
    }
    public function fetch(Request  $request){
        $validators = Validator($request->all(), [
            'auth_id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), false);
        }
        $licenses=License::where('user_id',$request->auth_id)->get();
        return $this->sendSuccess("Fetched successfully!",$licenses);
    }
    public function delete(Request $request){
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), false);
        }
        License::find($request->id)->delete();
        return $this->sendSuccess("License deleted successfully!",true);
    }
}
