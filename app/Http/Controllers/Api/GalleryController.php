<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\CommonTrait;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostAssets;
use Illuminate\Support\Facades\Auth;
class GalleryController extends Controller
{
    use CommonTrait;
    public function AllMedia(Request $request){
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $posts = Post::select('id','user_id')->where('user_id',$request->id)->get();
        $postasset=[];
        foreach($posts as $post){
            foreach (PostAssets::select('id','post_id','type','file','created_at')->where('post_id',$post->id)->get() as $asset){
                $postasset[]= $asset;
            }
        }
        $data['allmedia']=$postasset;
        return $this->sendSuccess("Fetch all Post successfully!",$data);

    }
    public function AllImages(Request $request){
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $postasset=[];
        $posts = Post::select('id','user_id')->where('user_id',$request->id)->get();
        foreach($posts as $post){
            foreach (PostAssets::select('id','post_id','type','file','created_at')->where('post_id',$post->id)->where('type' , 'image')->get() as $asset){
                $postasset[]= $asset;
            }
        }
        $data['allimages']=$postasset;
        return $this->sendSuccess("Fetch all images successfully!",$data);

      }
      public function AllVideo(Request $request){
          $validators = Validator($request->all(), [
              'id' => 'required',
          ]);
          if ($validators->fails()) {
              return $this->sendError($validators->messages()->first(), null);
          }
          $posts = Post::select('id','user_id')->where('user_id',$request->id)->get();
          $postasset=[];
          foreach($posts as $post){
            foreach (PostAssets::select('id','post_id','type','file','created_at')->where('post_id',$post->id)->where('type' , 'video')->get() as $asset){
                $postasset[]= $asset;
            }
        }

        $data['allvideos']=$postasset;
        return $this->sendSuccess("Fetch all Videos successfully!",$data);
      }
      public function AllAudio(Request $request){
          $validators = Validator($request->all(), [
              'id' => 'required',
          ]);
          if ($validators->fails()) {
              return $this->sendError($validators->messages()->first(), null);
          }
          $posts = Post::select('id','user_id')->where('user_id',$request->id)->get();
          $postasset=[];
          foreach($posts as $post){
            foreach (PostAssets::select('id','post_id','type','file','created_at')->where('post_id',$post->id)->where('type' , 'audio')->get() as $asset){
                $postasset[]= $asset;
            }
        }
        $data['allaudio']=$postasset;
        return $this->sendSuccess("Fetch all audio successfully!",$data);
      }
}