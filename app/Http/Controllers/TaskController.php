<?php

namespace App\Http\Controllers;
// app/Http/Controllers/TaskController.php

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create($projectId)
    {
        $project = Project::findOrFail($projectId);

        return view('task-create', compact('project'));
    }


    public function store(Request $request,Project $project)
    {
        $attributes = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:not started,in progress,completed,cancelled',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'member_id' => 'required|array',
            // 'member_id.*' => 'exists:users,id',
        ]);

        // Create the task associated with the project
        $task = Task::create([
            'name' => $attributes['name'],
            'description' => $attributes['description'],
            'status' => $attributes['status'],
            'start_date' => $attributes['start_date'],
            'end_date' => $attributes['end_date'],
            'project_id' => $project->id, // Assign project_id from the request
        ]);

        // Attach members to the task
        // $task->members()->sync($attributes['member_id']);

        return redirect()->route('tasks.index', compact('project'));
    }



    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $project = $task->project; // Assuming you have a relationship between Task and Project

        // Retrieve the list of members for the project
        $members = $project->members ? json_decode($project->members, true) : [];

        return view('task-edit', compact('task', 'project', 'members'));
    }

    public function update(Project $project)
    {
        // Validation and update logic here
        // $this->authorize('manageTasks', $project);
        return redirect()->route('dashboard')->with('success', 'Task updated successfully.');
    }

    public function destroy(Project $project, Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index', compact('project'));
    }


    // view tasks of a project from the project id in the url
    public function view(Project $project)
    {
        // $this->authorize('manageTasks', $project);
        $tasks = $project->tasks;
        // return $tasks;

        return view('tasks-index', compact('tasks', 'project'));
    }
}
