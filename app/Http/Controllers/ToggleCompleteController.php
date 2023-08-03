<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class ToggleCompleteController extends Controller
{
    public function switchToggleComplete(Task $task) {
        $task->toggleComplete();

        return redirect()->back()->with('success', $task->completed ? 'Task was completed' : 'Task was not completed');
    }
}
