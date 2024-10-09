<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        return Post::all();
    }

    public function singlePost(Post $id){
        return $id->only(['id','title','slug','description']);
    }

    public function storePost(Request $request){
        $post = new Post();
        $post->title = $request->get('title');
        $post->slug = $request->get('slug');
        $post->description = $request->get('description');
        $post->save();

        return response()->json("Post Added");
    }
}
