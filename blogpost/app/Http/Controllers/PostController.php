<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        return Post::all();
    }

    public function singlePost(Post $pid){
//        return $pid->with('getComment')->get(['id','title','slug','description'])->toArray();
//        return $pid->with('getComment')->get(['id','title','slug','description']);
        return $pid->load('getComment')->toArray();
    }

    public function storePost(Request $request){
        $post = new Post();
        $post->title = $request->get('title');
        $post->slug = $request->get('slug');
        $post->description = $request->get('description');
        $post->user_id = $request->get('user_id') ?? 18;
        $post->save();

        return response()->json("Post Added");
    }

    public function deletePost(Post $pid){
        $pid->delete();
        return response()->json('Post Deleted');
    }
}
