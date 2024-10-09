<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        return Task::all();
    }

    public function singleTask(Task $id){
        return $id->only(['id','title','slug','description']);
    }

    public function storeTask(Request $request){
        $task = new Task();
        $task->title = $request->get('title');
        $task->slug = $request->get('slug');
        $task->description = $request->get('description');
        $task->save();

        return response()->json("Task Added");
    }
}
