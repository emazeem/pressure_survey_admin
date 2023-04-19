<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\FileData;
use App\Models\Member;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as F;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class FileController extends Controller
{
    //
    public function index(){
        return view('admin.imports.index');
    }
    public function show($id){
        $import=File::with('teams')->find($id);
        $teams = Team::select('id','name')->get();
        $selectedValues=[];
        foreach ($import->teams as $v){
            $selectedValues[]=$v->id;
        }
        return view('admin.imports.show',compact('import','teams','selectedValues'));
    }

    public function edit(Request $request){
        $edit=File::find($request->id);
        return response()->json($edit);
    }
    public function destroy(Request $request){
        $file=File::find($request->id);
        F::delete('imports/'.$file->file);
        foreach ($file->fileData as  $fileDatum){
            $fileDatum->delete();
        }
        $file->delete();
        return response()->json(['success'=>'Import deleted successfully!']);
    }
    public function assign_team(Request $request){
        $file=File::find($request->id);
        $file->teams()->sync($request->teams);
        return response()->json(['success'=>'Updated!']);
    }


    public function fetch(Request $request){
        $data = File::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('file', function($v){
                return '<a target="_blank" href="'.$v->filePath().'">'.$v->fileName().'</a>';
            })
            ->addColumn('action', function($v){
                $actions ='
                <a href="'.url('file/show/'.$v->id).'" class="btn p-0"><i class="bx bx-show"></i></a>
                <a class="btn p-0 delete text-danger" data-id="'.$v->id.'" ><i class="bx bx-trash"></i></a>
                ';
                return $actions;
            })
            ->rawColumns(['action','file'])
            ->make(true);
    }
    public function submit(Request $request){
        $this->validate($request,[
            'file'=>'required'
        ]);
        if ($request->id==0){
            $message='File added successfully!';
            $role= new File();
        }else{
            $role= File::find($request->id);
            $message='File updated successfully!';
        }


        $fileName = uniqid() . '@' . $request->file->getClientOriginalName();
        $request->file->move(public_path('imports'), $fileName);
        $role->file=$fileName;
        $role->save();

        getFileContents('imports/'.$role->file,$role->id);

        return response()->json(['success'=>$message]);
    }
}
