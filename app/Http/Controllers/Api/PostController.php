<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Block;
use Illuminate\Http\Request;
use App\Models\UserDetail;
use App\Models\Post;
use App\Models\PostAssets;
use App\Models\User;
use App\Models\Friend;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Report;
use App\Http\Traits\CommonTrait;
use Friends;
class PostController extends Controller
{
    use CommonTrait;
    public function store(Request $request){
        if ($request->file_type){
            $postAsset=new PostAssets();
            if ($request->file_type=='audio'){
                $validators = Validator($request->all(), [
                    'attachment'=>'required',
                ]);
                if ($validators->fails()) {
                    return $this->sendError($validators->messages()->first(), null);
                }
            }

            if ($request->file_type=='video'){
                $validators = Validator($request->all(), [
                    'attachment'=>'required',
                    'thumbnail'=>'required',
                ]);
                if ($validators->fails()) {
                    return $this->sendError($validators->messages()->first(), null);
                }

            }
            if ($request->file_type=='image'){
                $this->validate($request,[
                    'attachment'=>'required|mimes:jpeg,jpg,png,gif',
                ]);
                $attachment=imageResize($request->attachment,'storage/a/posts/');
            }
            else{
                $time=time();
                $name= $time.$request->file_type;
                $attachment =$name.'.'.$request->attachment->getClientOriginalExtension();
                Storage::disk('local')->put('/public/a/posts/' . $attachment, File::get($request->attachment));

                if($request->file_type=='video'){
                    $thumbnail = 'thumbnail-'.$name.'.png';
                    Storage::disk('local')->put('/public/a/posts/' . $thumbnail, File::get($request->thumbnail));
                }
            }
            $postAsset->file=$attachment;
            $postAsset->type=$request->file_type;
        }else{
            $validators = Validator($request->all(), [
                'details' => 'required',
            ]);
            if ($validators->fails()) {
                return $this->sendError($validators->messages()->first(), null);
            }
        }
        $validators = Validator($request->all(), [
            'privacy' => 'required',
            'user' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }

        $post= new Post();
        $post->user_id=$request->user;
        $post->details=$request->details;
        $post->privacy=$request->privacy;
        $post->save();
        if ($request->file_type){
            $postAsset->post_id=$post->id;
            $postAsset->save();
        }
        $data=[];
        return $this->sendSuccess("Post added successfully",$data);
    }
    public function destroy(Request $request){
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $post=Post::find($request->id);
        $post->deleted_by=auth()->user()->id;
        if(auth()->user()->details->cover_photo==$post->assets->file){
            if ($post->type=='cover'){
                $user=User::find($post->user_id);
                $ambassador=UserDetail::find($user->details->id);
                $ambassador->cover_photo=null;
                $ambassador->save();
            }
        }
        if(auth()->user()->profile==$post->assets->file){
            if ($post->type=='profile'){
                $user=User::find($post->user_id);
                $user->profile=null;
                $user->save();
            }
        }
        if(auth()->user()->id==$post->user_id){
        $post->comments()->delete();
        $post->likes()->delete();
        $post->assets->delete();
        $post->delete();
        $data['post']=$post;
        return $this->sendSuccess("Post Deleted",$data);
        }else{
            return $this->sendError("Post not deleted",null);
        }

    }
    public function fetch_all(Request $request){
        $blockedUsersId=[];
        foreach (Block::where('from',\auth()->user()->id)->orwhere('to',\auth()->user()->id)->get() as $blockUser){
            if($blockUser->from==auth()->user()->id){
                $blockedUsersId[]=$blockUser->to;
            }
            if($blockUser->to==auth()->user()->id){
                $blockedUsersId[]=$blockUser->from;
            }
        }
        $posts = Post::Query()->whereNotIn('user_id',$blockedUsersId)->select('id', 'user_id', 'details', 'privacy', 'type', 'created_at')->with(['assets','user' => function ($query) {
            $query->select('id','fname','lname','profile','email');
        }])->orderBy('id', 'DESC')->get();
        foreach ($posts as $post){
            if (Friend::select('id','from','to','status')->where('to',auth()->user()->id)->where('from',$post->user_id)->orwhere('from',auth()->user()->id)->where('to',$post->user_id)->get()->count() == 0){
                $post['is_requested']= 0;
            }else{
                $post['is_requested']= 1;
            }
            $postdata = Like::where('post_id',$post->id)->where('user_id',$request->id)->get();
            $post['total-comments']=count($post->comments);
            $post['total-likes']=count($post->likes);
            $post['is-liked']=count($postdata)>0 ? 1 : 0;
        }

        $data['allposts']=$posts;

        return $this->sendSuccess("All public post fetch",$data);
    }
    public function my_posts(Request $request){
        $validators = Validator($request->all(), [
            'number' => 'required',
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }

        $posts = Post::Query()->select('id', 'user_id', 'details', 'privacy', 'type', 'created_at')->with(['assets','user' => function ($query) {
            $query->select('id','fname','lname','profile','email');
        }])->orderBy('id', 'DESC')->skip($request->number)->take(7)->where('user_id',$request->id)->get();
       // $posts = Post::with('user')->orderBy('id', 'DESC')->where('privacy',['public','friends'])->where('user_id',auth()->user()->id)->select('user_id','id','fname','lname')->get();
        $data['allposts']=$posts;
        $blockedUsersId=[];
        foreach (Block::where('from',\auth()->user()->id)->orwhere('to',\auth()->user()->id)->get() as $blockUser){
            if($blockUser->from==auth()->user()->id){
                $blockedUsersId[]=$blockUser->to;
            }
            if($blockUser->to==auth()->user()->id){
                $blockedUsersId[]=$blockUser->from;
            }
        }

        foreach ($posts as $post){
            $postdata = Like::where('post_id',$post->id)->whereNotIn('user_id',$blockedUsersId)->where('user_id',$request->id)->get();
            $post['total-comments']=count($post->comments);
            $post['total-likes']=count($post->likes);
            $post['is-liked']=count($postdata)>0 ? 1 : 0;
        }

        return $this->sendSuccess("All public post fetch",$data);
    }
    public function fetch_post(Request $request){
        $validators = Validator($request->all(), [
            'id' => 'required',
        ],[
            'id.required'=>'Post id field is required',
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
        $post = Post::Query()->select('id', 'user_id', 'details', 'privacy', 'type', 'created_at')->with(['assets','user' => function ($query) {
            $query->select('id','fname','lname','profile','email');
        }])->orderBy('id', 'DESC')->whereNotIn('user_id',$blockedUsersId)->where('id',$request->id)->first();

        $postdata = Like::where('post_id',$post->id)->where('user_id',$request->id)->get();
        $post['total-comments']=count($post->comments);
        $post['total-likes']=count($post->likes);
        $post['is-liked']=count($postdata)>0 ? 1 : 0;
        $data['post']=$post;

        return $this->sendSuccess("Fetched successfully!",$data);
    }

    public function fetch_friends()
    {
        $posts = Post::select('id', 'user_id', 'details', 'privacy', 'type', 'created_at')->with(['assets','user' => function ($query) {
            $query->select('id','fname','lname','profile','email');
        }])->where('privacy','friends')->where('user_id',auth()->user()->id)->get();
        //$posts = Post::with('user')->orderBy('id', 'DESC')->where('privacy','friends')->where('user_id',auth()->user()->id)->select('user_id','id','fname','lname')->get();
        $data['allposts']=$posts;
        return $this->sendSuccess("All friends post fetch",$data);

    }
    public function show(Request $request)
    {
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $post_like = Like::where('post_id',$request->id)->count();
        $post_comment = Comment::where('post_id',$request->id)->count();
        $posts = Post::where('id',$request->id)->where('user_id',auth()->user()->id)->get();
        $data['post']=$posts;
        $data['post-like']=$post_like;
        $data['post-comment']=$post_comment;
        return $this->sendSuccess(" post fetch",$data);

    }
    public function user_post(Request $request)
    {
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $posts = Post::select('id', 'user_id', 'details', 'privacy', 'type', 'created_at')->with(['assets','user' => function ($query) {
            $query->select('id','fname','lname','profile','email');
        }])->orderBy('id', 'DESC')->where('user_id',$request->id)->get();

        $data['post']=$posts;

        foreach ($posts as $post){
            $postdata = Like::where('post_id',$post->id)->where('user_id',$request->id)->get();
            $post['total-comments']=count($post->comments);
            $post['total-likes']=count($post->likes);
            $post['is-liked']=count($postdata)>0 ? 1 : 0;
        }

        return $this->sendSuccess(" post fetch",$data);

    }
    public function assets(Request $request)
    {
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $posts = PostAssets::where('post_id',$request->id)->get();
        $data['post_assets']=$posts;
        return $this->sendSuccess("post Assets fetch",$data);

    }
    public function fetch_like(Request $request)
    {
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $posts = Like::where('post_id',$request->id)->get();
        $data['fetch_like']=$posts;
        return $this->sendSuccess("post Like fetch",$data);
    }
    public function fetch_comment(Request $request)
    {
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $comments = Comment::Query()->whereNull('parent_id')->select('id', 'user_id', 'post_id', 'text', 'created_at','updated_at','parent_id')->with(['user' => function ($query) {
            $query->select('id','fname','lname','profile','email');
        }])->orderBy('id', 'DESC')->where('post_id',$request->id)->get();
        $data['fetch_comment']=$comments;
        return $this->sendSuccess("Comments fetched successfully!",$data);

    }

    public function Show_two_more(Request $request){

        $validators = Validator($request->all(), [
            'number' => 'required',
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
        $posts = Post::Query()->whereNotIn('user_id',$blockedUsersId)->select('id', 'user_id', 'details', 'privacy', 'type', 'created_at')->with(['assets','user' => function ($query) {
            $query->select('id','fname','lname','profile','email');
        }])->orderBy('id', 'DESC')->skip($request->number)->take(7)->get();



        foreach ($posts as $post){
            if (Friend::select('id','from','to','status')->where('to',auth()->user()->id)->where('from',$post->user_id)->orwhere('from',auth()->user()->id)->where('to',$post->user_id)->get()->count() == 0){
                $post['is_requested']= 0;
            }else{
                $post['is_requested']= 1;
            }
            $postdata = Like::where('post_id',$post->id)->where('user_id',$request->id)->get();
            $post['total-comments']=count($post->comments);
            $post['total-likes']=count($post->likes);
            $post['is-liked']=count($postdata)>0 ? 1 : 0;
        }
        $data['allposts']=$posts;
        return $this->sendSuccess("All public post fetch",$data);
    }

    public function create_report(Request $request){

        $validators = Validator($request->all(), [
            'user_id' => 'required',
            'post_id' => 'required',
            'description' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }

        $report = new Report();
        $report->user_id = $request->user_id;
        $report->post_id = $request->post_id;
        $report->description = $request->description;
        $report->save();

        return $this->sendSuccess("Post Reported successfully.", true);
    }
}
