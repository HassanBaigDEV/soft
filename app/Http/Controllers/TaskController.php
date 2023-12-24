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
        $project = $task->project;
        $members = $project->members ? json_decode($project->members, true) : [];
      
        return view('task-edit', compact('task', 'project', 'members'));
    }

    public function update(Request $request, Task $task)
    {
        // Validate the incoming request data
        $attributes = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:not started,in progress,completed,cancelled',
            'due_date' => 'required|date',
            'assigned_to' => 'required',
        ]);

        //string to int  convert
        $assigned = (int)$attributes['assigned_to'];

        // Find the task by ID
        $project = $task->project;
        // Update the task with the validated data
        $task->update([
            'name' => $attributes['name'],
            'description' => $attributes['description'],
            'status' => $attributes['status'],
            'assigned_to' => $assigned,
            'due_date' => $attributes['due_date'],
        ]);

        // Sync the members associated with the task
        // $task->members()->sync($request->input('member_id'));

        // Redirect back to the task edit page with a success message
        return redirect()->route('tasks.index', compact('project'))->with('success', 'Task updated successfully.');
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
