<?php

namespace App\Http\Controllers;
// app/Http/Controllers/ProjectController.php

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;


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
        $allTeams = Team::all(); // Get all teams

        $teams = [];

        foreach ($allTeams as $team) {
            $teamMembers = json_decode($team->members, true);

            // Check if the user is a member of the team
            $isUserMember = collect($teamMembers)->contains(function ($member) use ($user) {
                return $member['id'] === $user->id;
            });

            if ($isUserMember) {
                // Filter team members based on user ID
                $filteredMembers = collect($teamMembers)->filter(function ($member) use ($user) {
                    return $member['id'] === $user->id;
                })->values()->toArray();

                $team->filteredMembers = $filteredMembers;
                $teams[] = $team;
            }
        }

        return view('project-create', compact('teams'));
    }

    public function store(Request $request, Team $team)
    {
        $this->authorize('editProject', $team);

        $attributes = $request->validate([
            'name' => ['required', 'max:255'],
            'team_id' => ['required', 'exists:teams,id'],
            // Add other validation rules as needed
        ]);

        $project = Project::create($attributes);

        return redirect()->route('dashboard')->with('success', 'Project created successfully.');
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
        $projects = Project::all();
        return view('projects-view', compact('projects'));
    }
}
