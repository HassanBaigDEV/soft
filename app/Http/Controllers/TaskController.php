<?php

namespace App\Http\Controllers;
// app/Http/Controllers/TaskController.php

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TaskController extends Controller
{
    public function create($projectId)
    {
        $project = Project::findOrFail($projectId);

        return view('task-create', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $attributes = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:not started,in progress,completed,cancelled',
            'due_date' => 'required|date',
            'assigned_to' => 'required',
            // 'member_id.*' => 'exists:users,id',
        ]);

        $assigined = json_decode($attributes['assigned_to']);
        
        // Create the task associated with the project
        $task = Task::create([
            'name' => $attributes['name'],
            'description' => $attributes['description'],
            'status' => $attributes['status'],
            'assigned_to' => $assigined->id,
            'due_date' => $attributes['due_date'],
            'project_id' => $project->id, // Assign project_id from the request
        ]);

        // Attach members to the task
        // $task->members()->sync($attributes['member_id']);

        return redirect()->route('tasks.index', compact('project'));
    }

    public function edit(Task $task)
    {
        $task = Task::findOrFail($task->id);
        $project = $task->project; // Assuming you have a relationship between Task and Project

        // Retrieve the list of members for the project
        $members = $project->members ? json_decode($project->members, true) : [];

        return view('task-edit', compact('task', 'project', 'members'));
    }

    public function update(Request $request, Task $task)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'member_id' => 'required|array',
            // 'member_id.*' => 'exists:members,id', // Assuming members table has 'id' column
            'status' => 'required|in:not started,in progress,completed,cancelled',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        // Find the task by ID
        $project = $task->project;
        // Update the task with the validated data
        $task->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ]);

        // Sync the members associated with the task
        // $task->members()->sync($request->input('member_id'));

        // Redirect back to the task edit page with a success message
        return redirect()->route('tasks.index', compact('project'));
    }

    public function destroy(Task $task)
    {
        try {
            DB::beginTransaction();
            $task->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Task deleted successfully.');
        } catch (\Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollback();

            // Redirect with error mesage
            return redirect()->back()->with('error', 'Failed to delete task.');
        }
    }

    public function view(Project $project)
    {
        // $this->authorize('manageTasks', $project);
        $tasks = $project->tasks;

        return view('tasks-index', compact('tasks', 'project'));
    }
}
