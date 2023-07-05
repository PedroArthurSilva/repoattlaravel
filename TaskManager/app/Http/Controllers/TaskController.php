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
        $tasks = Task::all();
        return response()->json($tasks);
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
       $request->validate([
          'title' => 'required',
          'description' => 'required'
       ]);

       $task = Task::create([
          'title' => $request->input('title'),
          'description' => $request->input('description'),
          'completed' => $request->input('completed', false),
       ]);
       
        return response()->json(task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $task = Task::findOrFail($id);

        return response()->json($task);
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
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $task = Task::findOrFail($task);
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->completed = $request->input('completed', false);
        $task->save();

        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task = Task::findOrFail($task);
        $task->delete();
        return response()->json(null, 204);
    }

    protected function validateTask(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'completed' => 'boolean'
        ]);
    }
}

