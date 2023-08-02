@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <a href="{{ route('tasks.index') }}" class="link">← Go back to the task list!</a>
    </div>

    <p class="mb-4 text-slate-700">{{ $task->description }}</p>

    @if ($task->long_description)
        <p class="mb-4 text-slate-700">{{ $task->long_description }}</p>
    @endif

    <p class="mb-4 text-sm text-slate-500">Created {{ $task->created_at->diffForHumans() }} • Updated
        {{ $task->updated_at->diffForHumans() }}</p>

    <p class="mb-4">
        @if ($task->completed)
            <span class="font-medium text-green-500">Completed</span>
        @else
            <span class="font-medium text-red-500">Not completed</span>
        @endif
    </p>

    <div class="flex gap-2">
        <form method="POST" action="{{ route('tasks.complete', ['task' => $task]) }}">
            @csrf
            @method('PUT')
            <button class="btn btn-primary btn-block" type="submit">
                Mark as {{ $task->completed ? 'not completed' : 'completed' }}
            </button>
        </form>

        <form action="{{ route('tasks.edit', ['task' => $task->id]) }}">
            @csrf
            <button class="btn btn-primary btn-block" type="submit">Edit</button>
        </form>

        <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-primary btn-block" type="submit">Delete</button>
        </form>
    </div>

@endsection
