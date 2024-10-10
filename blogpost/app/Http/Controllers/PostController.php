<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        return Post::withCount('getComment')->get();
    }

    public function singlePost(Post $pid){
        return $pid->load('getComment')->toArray();
    }

    public function storePost(Request $request){
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug',
            'description' => 'required|string',
            'user_id' => 'nullable|integer|exists:users,id',
        ]);

        $post = new Post();
        $post->title = $request->get('title');
        $post->slug = $request->get('slug');
        $post->description = $request->get('description');
        $post->user_id = $request->get('user_id') ?? 18;
        $post->save();

        return response()->json(['message'=>"Post Added",'status'=>201]);
    }

    public function updatePost(Request $r,Post $pid){
        $pid->update($r->all());
        return response()->json("Post Updated");
    }

    public function deletePost(Post $pid){
        $pid->delete();
        return response()->json('Post Deleted');
    }
}
