<?php

namespace App\Http\Controllers;
// app/Http/Controllers/TaskController.php

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Project $project)
    {
        $this->authorize('manageTasks', $project);
        // Fetch user's projects to populate project dropdown
        $projects = auth()->user()->projects;

        return view('tasks.create', compact('projects'));
    }

    public function store(Request $request, Project $project)
    {
        $this->authorize('manageTasks', $project);

        $attributes = $request->validate([
            'name' => ['required', 'max:255'],
            'project_id' => ['required', 'exists:projects,id'],
            // Add other validation rules as needed
        ]);

        $task = Task::create($attributes);

        return redirect()->route('dashboard')->with('success', 'Task created successfully.');
    }
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Project $project)
    {
        // Validation and update logic here
        $this->authorize('manageTasks', $project);
        return redirect()->route('dashboard')->with('success', 'Task updated successfully.');
    }

    public function destroy(Project $project)
    {
        // Delete logic here
        $this->authorize('manageTasks', $project);
        return redirect()->route('dashboard')->with('success', 'Task deleted successfully.');
    }
}
