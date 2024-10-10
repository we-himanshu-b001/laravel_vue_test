<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function add(Request $request){
        $comment = new Comment();
        $comment->post_id = $request->get('post_id');
        $comment->task_id = $request->get('task_id');
        $comment->comment = $request->get('comment');
        $comment->user_id = $request->get('user_id') ?? 107;
        $comment->save();

        return response()->json('Comment Added');
    }
}
