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

        $assigned = json_decode($attributes['assigned_to']);
        $assigined = $attributes['members'] = json_encode($assigned);
        return $assigined;





        // Create the task associated with the project
        $task = Task::create([
            'name' => $attributes['name'],
            'description' => $attributes['description'],
            'status' => $attributes['status'],
            // 'assigned_to' => ,
            'due_date' => $attributes['due_date'],
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


    // view tasks of a project from the project id in the url
    public function view(Project $project)
    {
        // $this->authorize('manageTasks', $project);
        $tasks = $project->tasks;
        // return $tasks;

        return view('tasks-index', compact('tasks', 'project'));
    }
}
