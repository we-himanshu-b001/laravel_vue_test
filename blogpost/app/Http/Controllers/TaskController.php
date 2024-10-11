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
        try{
            $request->validate([
                'title' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:posts,slug',
                'description' => 'required|string',
                'user_id' => 'nullable|integer',
            ]);

            $task = new Task();
            $task->title = $request->get('title');
            $task->slug = $request->get('slug');
            $task->description = $request->get('description');
            $task->user_id = $request->get('user_id') ?? 107;
            $task->save();

            return response()->json(['message'=>"Post Added",'status'=>201]);
        }catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json($e->validator->errors(), 422);
        }

    }

    public function updateTask(Request $r,Task $tid){
        try {
            $validatedData = $r->validate([
                'title' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:posts,slug,' . $tid->id,
                'description' => 'required|string',
                'user_id' => 'nullable|integer',
            ]);

            $tid->update($validatedData);
            return response()->json("Post Updated");
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json($e->validator->errors(), 422);
        }
    }

    public function deleteTask(Task $tid){
        $tid->delete();
        return response()->json('Task Deleted');
    }
}
