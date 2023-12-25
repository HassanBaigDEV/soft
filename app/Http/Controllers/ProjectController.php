<?php

namespace App\Http\Controllers;
// app/Http/Controllers/ProjectController.php

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function create(Team $team)
    {
        $user = auth()->user();
        $teams = Team::where('team_head', $user->id)->get(); // Get all teams

        return view('project-create', compact('teams'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'max:255'],
            'team_id' => ['required', 'exists:teams,id'],
            'description' => ['nullable', 'string'],
            'members' => ['nullable'],
            'status' => ['required', 'in:not started,in progress,completed,cancelled'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            // Add other validation rules as needed
        ]);

        $authenticatedUser = Auth::user();
        $members = json_decode($attributes['members'], true) ?? [];

        // Check if the authenticated user is already in the members array
        $existingUserIndex = collect($members)->search(function ($member) use ($authenticatedUser) {
            return $member['id'] === $authenticatedUser->id;
        });

        if ($existingUserIndex === false) {
            // Add the authenticated user to the members array
            $members[$authenticatedUser->id] = [
                'id' => $authenticatedUser->id,
                'name' => $authenticatedUser->name,
            ];
        }

        // Encode the members array
        $attributes['members'] = json_encode($members);

        $team_id = $attributes['team_id'];
        $name = $attributes['name'];
        $description = $attributes['description'];
        $status = $attributes['status'];
        $start_date = $attributes['start_date'];
        $end_date = $attributes['end_date'];
        $created_at = now();

        try {
            DB::unprepared("INSERT INTO projects (team_id, name, description, members, status, start_date, end_date, created_at) VALUES ('$team_id','$name','$description','$attributes[members]','$status','$start_date','$end_date','$created_at')");
            return redirect()->route('projects.view')->with('success', 'Project created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create the project.');
        }
    }

    public function edit(Project $project)
    {
        $team = $project->team;
        $members = json_decode($team->members, true);
        $teams = Team::all();
        return view('project-edit', compact('project', 'team', 'members', 'teams'));
    }

    public function update(Request $request, Project $project)
    {
        // $this->authorize('editProject', $team);
        $attributes = $request->validate([
            'name' => ['required', 'max:255'],
            'team_id' => ['required', 'exists:teams,id'],
            'description' => ['nullable', 'string'],
            'members' => ['nullable'],
            'status' => ['required', 'in:not started,in progress,completed,cancelled'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            // Add other validation rules as needed
        ]);
        $authenticatedUser = Auth::user();
        $members = json_decode($attributes['members'], true) ?? [];
        $members[] = ['id' => $authenticatedUser->id, 'name' => $authenticatedUser->name];

        $members = $attributes['members'] = json_encode($members);


        $team_id = $attributes['team_id'];
        $name = $attributes['name'];
        $description = $attributes['description'];
        $status = $attributes['status'];
        $start_date = $attributes['start_date'];
        $end_date = $attributes['end_date'];
        $updated_at = now();

        try {
            DB::table('projects')
                ->where('id', $project->id)
                ->update([
                    'team_id' => $team_id,
                    'name' => $name,
                    'description' => $description,
                    'members' => $members,
                    'status' => $status,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'updated_at' => $updated_at,  // Assuming you want to update the created_at field as well
                ]);
            return redirect()->route('projects.view')->with('success', 'Project Updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create the project.');
        };
    }


    public function destroy(Request $request, Project $project)
    {
        try {
            // Use a transaction to ensure data consistency
            DB::beginTransaction();

            // Delete the project
            $project->delete();

            // Commit the transaction
            DB::commit();


            // Redirect with success message
            return redirect()->route('projects.view')->with('success', 'Project deleted successfully.');
        } catch (\Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollback();

            // Redirect with error message
            return redirect()->route('projects.view')->with('error', 'Failed to delete project.');
        }
    }

    public function view()
    {
        $user = auth()->user();
        $allProjects = Project::all();
        $projects = [];

        foreach ($allProjects as $project) {
            $projectMembers = json_decode($project->members, true);

            // Make sure $projectMembers is an array
            if (is_array($projectMembers)) {
                // Check if the user is a member of the project
                $isUserMember = collect($projectMembers)->contains(function ($member) use ($user) {
                    return is_array($member) && isset($member['id']) && $member['id'] === $user->id;
                });

                if ($isUserMember) {
                    // Filter project members based on user ID
                    $filteredMembers = collect($projectMembers)->filter(function ($member) use ($user) {
                        return is_array($member) && isset($member['id']) && $member['id'] === $user->id;
                    })->values()->toArray();

                    $project->filteredMembers = $filteredMembers;
                    $projects[] = $project;
                }
            }
        }

        return view('projects-view', compact('projects'));
    }
  
}
