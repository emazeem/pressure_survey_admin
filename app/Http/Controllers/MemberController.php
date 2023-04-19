<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Team;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MemberController extends Controller
{
    //
    public function index(){
        $teams=Team::select('name','id')->get();
        return view('admin.members.index',compact('teams'));
    }
    public function edit(Request $request){
        $edit=Member::find($request->id);
        return response()->json($edit);
    }
    public function destroy(Request $request){
        Member::find($request->id)->delete();
        return response()->json(['success'=>'Role deleted successfully!']);
    }

    public function fetch(Request $request){
        $data = Member::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($v){
                $actions =
                    '<a href="#" class="btn p-0 edit" data-id="'.$v->id.'"><i class="bx bx-edit"></i></a>
                    <a href="#" class="btn p-0 delete" data-id="'.$v->id.'"><i class="bx bx-trash"></i></a>';
                return $actions;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function submit(Request $request){
        $this->validate($request,[
            'team_id'=>'required',
            'name'=>'required|max:40|string',
            'cnic'=>'required|max:20|string',
            'phone'=>'required|max:20|string',
            'address'=>'required|max:200|string',
        ]);
        if ($request->id==0){
            $message='Member added successfully!';
            $role= new Member();
        }else{
            $role= Member::find($request->id);
            $message='Member updated successfully!';
        }
        $role->team_id=$request->team_id;
        $role->name=$request->name;
        $role->cnic=$request->cnic;
        $role->phone=$request->phone;
        $role->address=$request->address;
        $role->save();
        return response()->json(['success'=>$message]);
    }
}
