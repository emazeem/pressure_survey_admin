<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TeamController extends Controller
{
    //
    public function index(){
        return view('admin.teams.index');
    }
    public function edit(Request $request){
        $edit=Team::find($request->id);
        return response()->json($edit);
    }
    public function destroy(Request $request){
        Team::find($request->id)->delete();
        return response()->json(['success'=>'Role deleted successfully!']);
    }

    public function fetch(Request $request){
        $data = Team::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('members', function($v){
                $members=null;
                foreach ($v->members as $member){
                    $members.=$member->name.'<br>';
                }
                return $members;
            })
            ->addColumn('action', function($v){
                $actions =
                    '<a href="#" class="btn p-0 edit" data-id="'.$v->id.'"><i class="fa fa-edit"></i></a>';
                    //<a href="#" class="btn p-0 delete" data-id="'.$v->id.'"><i class="fa fa-trash"></i></a>';
                return $actions;
            })
            ->rawColumns(['action','members'])
            ->make(true);
    }
    public function submit(Request $request){
        $this->validate($request,[
            'name'=>'required|max:40|string'
        ]);
        if ($request->id==0){
            $message='Team added successfully!';
            $role= new Team();
        }else{
            $role= Team::find($request->id);
            $message='Team updated successfully!';
        }
        $role->name=$request->name;
        $role->save();
        return response()->json(['success'=>$message]);
    }
}
