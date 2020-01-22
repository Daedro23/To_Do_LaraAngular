<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $task = Task::all();
        return $task;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('tasks.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task();
        $this->validate($request, [
            'name'        => 'required|max:255',
            'description' => 'required',
        ]);
        $task->name = $request->name;
        $task->description = $request->description;

        $task->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($request->id);
        return $task;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    // public function edit(Task $task)
    // {

    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Task $task)
        {
            $this->validate($request, [
            ]);
            $task->name = request('name');
            $task->description = request('description');
            $task->save();
     
            return response()->json([
                'message' => 'Task updated successfully!'
            ], 200);
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Task::where('id', $id)->exists()) {
            $task = Task::find($id);
            $task->delete();
    
            return response()->json([
              "message" => "Task deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "Task not found"
            ], 404);
          }
    }
}
