<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\CommonTrait;
use App\Models\InspectionPoint;
use App\Models\Team;
use Illuminate\Http\Request;

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
            $file->name=$file->fileName();
            $files[]=$file;
        }
        return $this->sendSuccess("Data fetched successfully!", $files);
    }

    public function createInspectionPoint(Request  $request){
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
    //
}
