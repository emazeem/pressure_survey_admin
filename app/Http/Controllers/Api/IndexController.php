<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\CommonTrait;
use App\Models\File;
use App\Models\FileData;
use App\Models\InspectionPoint;
use App\Models\IpImages;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    use CommonTrait;
    public function getTeams(){
        $teams=Team::all();
        return $this->sendSuccess("Data fetched successfully!", $teams);
    }
    public function getUserFromTeam(Request $request){
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $team=Team::find($request->id);
        return $this->sendSuccess("Data fetched successfully!", $team->members);
    }
    public function getFileData(Request $request){
        $validators = Validator($request->all(), [
            'file_id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $import=File::with('fileData')->find($request->file_id);
        $files=[];
        foreach ($import->fileData->whereNull('ip_id') as $fileDatum){
            $files[]=$fileDatum;
        }
        return $this->sendSuccess("Data fetched successfully!", $files);
    }

    public function filesOfTeam(Request $request){
        $validators = Validator($request->all(), [
            'team_id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $team=Team::with('files')->find($request->team_id);
        $files=[];
        foreach ($team->files as $file){
            $file->file=$file->fileName();
            $files[]=$file;
        }
        return $this->sendSuccess("Data fetched successfully!", $files);
    }
    public function storeMetersAgainstIp(Request $request){
        $validators = Validator($request->all(), [
            'ip_id' => 'required',
            'meters' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        foreach (explode(',',$request->meters) as $meter){
            $m=FileData::find($meter);
            $m->ip_id=$request->ip_id;
            $m->save();
        }
        return $this->sendSuccess("Data stored successfully!", true);
    }

    public function createInspectionPoint(Request  $request){
        $validators = Validator($request->all(), [
            'file_id' => 'required',
            'team_id' => 'required',
            'member_id' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }

        $point=new InspectionPoint();
        $point->file_id=$request->file_id;
        $point->team_id=$request->team_id;
        $point->member_id=$request->member_id;
        $point->title=$request->name;
        $point->name=$request->name;
        $point->description=$request->description;
        $point->save();
        $team=Team::find($request->team_id);
        $point->title='IP-'.str_pad($point->id,5,0,STR_PAD_LEFT).'-('.$team->name.')';
        $point->save();
        return $this->sendSuccess("Data created successfully!", true);
    }
    public function fetchIpList(Request  $request){
        $validators = Validator($request->all(), [
            'file_id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $file=File::with('ip')->find($request->file_id);

        $ip=[];
        foreach ($file->ip as $i){
            $inspectionPoint=$i;
            $inspectionPoint['meter_count']=count($i->data);
            $ip[]=$inspectionPoint;
        }

        return $this->sendSuccess("Data fetched successfully!", $ip);
    }
    public function getSelectedMeters(Request $request){
        $validators = Validator($request->all(), [
            'ip_id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }

        $ip=InspectionPoint::find($request->ip_id);
        return $this->sendSuccess("Data fetched successfully!", $ip->data);
    }
    public function updateFileData(Request $request){
        $validators = Validator($request->all(), [
            'data' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $data=explode('##',$request->data);
        foreach ($data as $datum){
            $sub=explode('@',$datum);
            $d=FileData::find($sub[0]);
            $d->pressure=($sub[1])?$sub[1]:'0.0';
            $d->save();
        }
        return $this->sendSuccess("Data updated successfully!", true);
    }
    public function updateImages(Request $request){
        $validators = Validator($request->all(), [
            'image' => 'required',
            'ip_id' => 'required',
            'type' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        IpImages::where('type',$request->type)->where('ip_id',$request->ip_id)->delete();
        $attachment =$request->type.'-'.time().rand(100000,999999).'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('ip'), $attachment);
        $image=new IpImages();
        $image->type=$request->type;
        $image->ip_id=$request->ip_id;
        $image->image=$attachment;
        $image->save();


        return $this->sendSuccess("Image added successfully!", true);
    }
    public function fetchImages(Request $request){
        $validators = Validator($request->all(), [
            'ip_id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $ip=InspectionPoint::find($request->ip_id);
        return $this->sendSuccess("Image fetched successfully!", $ip->images);
    }



    //
}
