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
        try{
            $request->validate([
                'title' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:posts,slug',
                'description' => 'required|string',
                'user_id' => 'nullable|integer',
            ]);

            $post = new Post();
            $post->title = $request->get('title');
            $post->slug = $request->get('slug');
            $post->description = $request->get('description');
            $post->user_id = $request->get('user_id') ?? 18;
            $post->save();

            return response()->json(['message'=>"Post Added",'status'=>201]);
        }catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json($e->validator->errors(), 422);
        }

    }

    public function updatePost(Request $r,Post $pid){
        try {
            $validatedData = $r->validate([
                'title' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:posts,slug,' . $pid->id,
                'description' => 'required|string',
                'user_id' => 'nullable|integer',
            ]);

            $pid->update($validatedData);
            return response()->json("Post Updated");
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json($e->validator->errors(), 422);
        }
    }

    public function deletePost(Post $pid){
        $pid->delete();
        return response()->json('Post Deleted');
    }
}
