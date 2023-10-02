<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class TasksController extends Controller
{
    public function layout (){
        return view('tasks');
    }

    public function index()
    {
        // Retrieve all categories
        $task = Task::all();

        return response()->json($task);
    }

    public function show($id)
    {
        // Retrieve a specific category
        $task = Task::findOrFail($id);

        // Retrieve a specific user
        //$user = User::where('email', $userName)->firstOrFail();

        // Retrieve tasks for the user
        //$tasks = Task::where('user_name', $userName)->get();


        return response()->json($task);
    }


}
