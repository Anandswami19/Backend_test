<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Retrieve all tasks
    public function index(Request $request)
    {
        // Optional: Filter tasks based on completion status
        $completed = $request->query('completed');
        $tasks = Task::when($completed !== null, function ($query) use ($completed) {
            return $query->where('completed', $completed);
        })->get();
        return response()->json($tasks);
    }

    // Retrieve a specific task
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task);
    }

    // Create a new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task = Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return response()->json($task, 201);
    }

    // Update an existing task
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean',
        ]);

        $task->update($request->all());
        return response()->json($task);
    }

    // Delete a task
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(null, 204);
    }
}
