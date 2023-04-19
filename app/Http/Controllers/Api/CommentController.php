<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Block;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Http\Traits\CommonTrait;
class CommentController extends Controller
{
    use CommonTrait;
    public function store(Request $request)
    {
        $validators = Validator($request->all(), [
            'comment' => 'required',
            'post_id' => 'required',
            'user_id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $comment = new Comment();
        $comment->user_id = $request->user_id;
        $comment->post_id = $request->post_id;
        $comment->parent_id = $request->parent_id?$request->parent_id:null;
        $comment->text = $request->comment;
        $comment->save();
        $post = Post::find($request->post_id);
        if (auth()->user()->id != $post->user_id){
            a_notification($post->user_id, '<b>' . auth()->user()->fullName() . '</b> commented on your post.',['url'=>'post','data'=>(int) $post->id]);
        }
        $data['comment']=$comment;
        return $this->sendSuccess("Comment Added successfully",$data);
    }

    public function delete(Request $request)
    {
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), false);
        }
        $comment = Comment::find($request->id);
        $comment->deleted_by=auth()->user()->id;
        $comment->save();
        $comment->delete();

        return $this->sendSuccess("Comment deleted successfully!",true);

    }
    public function update(Request $request)
    {
        $validators = Validator($request->all(), [
            'id' => 'required',
            'comment' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), false);
        }
        $comment = Comment::find($request->id);
        $comment->text=$request->comment;
        $comment->save();
        return $this->sendSuccess("Comment updated successfully!",true);

    }

    public function fetch_reply(Request $request){
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), false);
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
        $replies = Comment::where('parent_id',$request->id)
            ->whereNotIn('user_id',$blockedUsersId)
            ->get();
        $data['comments']=$replies;
        return $this->sendSuccess("Replies fetched successfully!",$data);
    }

    public function show(Request $request){
        $validators = Validator($request->all(), [
            'post' => 'required',
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
        $comment = Comment::leftJoin('users','comments.user_id','=','users.id')
            ->select('comments.id','comments.parent_id','comments.user_id','comments.post_id','comments.text','comments.created_at','users.id','users.fname','users.lname','users.email','users.profile')
            ->whereNotIn('user_id',$blockedUsersId)
            ->whereNull('parent_id')
            ->where('post_id',$request->post)->get();
        $data['comment']=$comment;
        return $this->sendSuccess("Comment  fetch successfully",$data);
    }
}
