<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Block;
use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Http\Traits\CommonTrait;

class LikeController extends Controller
{
    use CommonTrait;
    public function Unlike(Request $request)
    {
        $validators = Validator($request->all(), [
            'post' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $find = Like::where('post_id', $request->post)->where('user_id', auth()->user()->id)->first();
        $data = ['post_id'=>$request->post];
        if ($find) {
            $find->delete();
            $post = Post::find($request->post);
            $data['unlike']=$find;
            return $this->sendSuccess("un-liked",$data);
        }
    }
    public function like(Request $request){
        $validators = Validator($request->all(), [
            'post' => 'required',
            'user' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }

        $find = Like::where('post_id', $request->post)->where('user_id', $request->user)->get();
        if($find->count()>0){
            foreach ($find as $item){
                $item->delete();
            }
            $success=false;
        }else{
            $success=true;
            $like = new Like();
            $like->post_id = $request->post;
            $like->user_id = $request->user;
            $like->save();
            $post = Post::find($request->post);
            if(auth()->user()->id!=$post->user_id){
                a_notification($post->user_id,'<b>'.auth()->user()->fullName().'</b> liked your post.',['url'=>'post','data'=>(int)$post->id]);
            }
        }
        $data['like']=$success;
        return $this->sendSuccess("liked",$data);
    }
    public function fetch(Request $request){
        $validators = Validator($request->all(), [
                'post' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $blockedUsersId=[];
        foreach (Block::query()->where('from',\auth()->user()->id)->orwhere('to',\auth()->user()->id)->get() as $blockUser){
            if($blockUser->from==auth()->user()->id){
                $blockedUsersId[]=$blockUser->to;
            }
            if($blockUser->to==auth()->user()->id){
                $blockedUsersId[]=$blockUser->from;
            }
        }
        $data['likes']=Like::query()->whereNotIn('user_id',$blockedUsersId)->where('post_id',$request->post)->with(['user' => function ($query) {
            $query->select('id','fname','lname','profile','email');
        }])->get();

        return $this->sendSuccess("liked",$data);
    }


}
