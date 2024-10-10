<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        return Task::withCount('getComment')->get();
    }

    public function singleTask(Task $tid){
        return $tid->load('getComment')->toArray();
    }

    public function storeTask(Request $request){
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug',
            'description' => 'required|string',
            'user_id' => 'nullable|integer|exists:users,id',
        ]);
        $task = new Task();
        $task->title = $request->get('title');
        $task->slug = $request->get('slug');
        $task->description = $request->get('description');
        $task->user_id = $request->get('user_id') ?? 18;
        $task->save();

        return response()->json("Task Added");
    }

    public function updatePost(Request $r,Task $tid){
        $tid->update($r->all());
        return response()->json("Task Updated");
    }

    public function deleteTask(Task $tid){
        $tid->delete();
        return response()->json('Task Deleted');
    }
}
