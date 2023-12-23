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
        // $this->authorize('editProject', $team);
        // Fetch user's teams to populate team dropdown
        // $user = auth()->user();

        // Retrieve teams where the user is a member
        // $teams = Team::whereJsonContains('members', ['id' => $user->id, 'name' => $user->name])->get();


        // $allMembers = [];
        // foreach ($teams as $team) {
        //     // Assuming 'members' is the column containing the JSON data in the teams table
        //     $membersJson = $team->members;
        //     $members = json_decode($membersJson, true);
        //     $allMembers = array_merge($allMembers, $members);
        // }
        // return $allMembers;
        // return view('project-create', compact('teams'));

        $user = auth()->user();
        $teams = Team::where('team_head', $user->id)->get(); // Get all teams

        // $teams = [];

        // foreach ($allTeams as $team) {
        //     $teamMembers = json_decode($team->members, true);

        //     // Check if the user is a member of the team
        //     $isUserMember = collect($teamMembers)->contains(function ($member) use ($user) {
        //         return $member['id'] === $user->id;
        //     });

        //     if ($isUserMember) {
        //         // Filter team members based on user ID
        //         $filteredMembers = collect($teamMembers)->filter(function ($member) use ($user) {
        //             return $member['id'] === $user->id;
        //         })->values()->toArray();

        //         $team->filteredMembers = $filteredMembers;
        //         $teams[] = $team;
        //     }
        // }

        return view('project-create', compact('teams'));
    }

    public function store(Request $request)
    {
        // $this->authorize('editProject', $team);

        // Validate the form data

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

        // You can customize the members field based on your form structure
        // For example, if you're sending an array of members, you might want to encode it as JSON
        // $attributes['members'] = json_encode($request->input('members'));

        // Set additional fields
        // ...

        // Add the current authenticated user as a member if not already in the members list

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


        try {


            DB::unprepared("Insert into projects (team_id, name, description, members, status, start_date, end_date) values ('$team_id','$name','$description','$members','$status','$start_date','$end_date')");

            return redirect()->route('projects.view')->with('success', 'Project created successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction on exception
            DB::rollBack();

            // Handle the exception as needed
            return redirect()->back()->with('error', 'Failed to create the project.');
        };
    }

    public function edit(Project $project, Team $team)
    {

        return view('projects.edit', compact('project'));
    }

    public function update(Team $team)
    {
        // Validation and update logic here
        $this->authorize('editProject', $team);

        return redirect()->route('dashboard')->with('success', 'Project updated successfully.');
    }

    public function destroy(Request $request, Project $project)
    {
        // Delete logic here



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
        // $projects = Project::all();
        $user = auth()->user();
        $allProjects = Project::all();
        $projects = [];

        foreach ($allProjects as $project) {
            $projectMembers = json_decode($project->members, true);

            // Check if the user is a member of the project
            $isUserMember = collect($projectMembers)->contains(function ($member) use ($user) {
                return $member['id'] === $user->id;
            });

            if ($isUserMember) {
                // Filter project members based on user ID
                $filteredMembers = collect($projectMembers)->filter(function ($member) use ($user) {
                    return $member['id'] === $user->id;
                })->values()->toArray();

                $project->filteredMembers = $filteredMembers;
                $projects[] = $project;
            }
        }
        return view('projects-view', compact('projects'));
    }
}
