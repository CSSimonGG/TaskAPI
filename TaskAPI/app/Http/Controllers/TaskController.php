<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Task::orderBy('created_at', 'asc')->get(); //returns values in ascending order
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'title' => 'required',
           'description' => 'required',
        ]);

        $task = new Task;
        $task->title = $request->input('title'); // Retrieve user inputted title
        $task->description = $request->input('description'); // Retrieve user inputted description
        $task->save();

        return $task;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Task::findorFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        $task = Task::findorFail($id); // Search task with id
        $task->title = $request->input('title'); // Retrieve user inputted title
        $task->description = $request->input('description'); // Retrieve user inputted description
        $task->save();

        return $task;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $task = Task::findorFail($id); // Search task with id

       if($task->delete())
       {
           return 'deleted successfully';
       }
    }
}
