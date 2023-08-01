<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index', ['tasks' => Task::latest()->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {

        $task = Task::create($request->validated());

        return redirect()->route('tasks.show', ['task' => $task->id])
            ->with('success', 'New Task!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('show', ['task' => Task::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('edit', ['task' => Task::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, string $id)
    {
        $newTask = $request->validated();
        $oldTask = Task::findOrFail($id);

//        $oldTask->fill($newTask);
        $oldTask->update($newTask);
//        $oldTask->save();


        return redirect()->route('tasks.show', ['task' => $oldTask->id])->with('success', 'Task was edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', "Task '" . $task->title . "' was deleted!");
    }
}
