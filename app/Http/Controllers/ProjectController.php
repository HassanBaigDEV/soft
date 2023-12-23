<?php

namespace App\Http\Controllers;
// app/Http/Controllers/ProjectController.php

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Gate;


class ProjectController extends Controller
{
    public function create(Team $team)
    {
        // $this->authorize('editProject', $team);
        // Fetch user's teams to populate team dropdown
        $user = auth()->user();

        // Retrieve teams where the user is a member
        $teams = Team::whereJsonContains('members', ['id' => $user->id, 'name' => $user->name])->get();
        // $allMembers = [];
        // foreach ($teams as $team) {
        //     // Assuming 'members' is the column containing the JSON data in the teams table
        //     $membersJson = $team->members;
        //     $members = json_decode($membersJson, true);
        //     $allMembers = array_merge($allMembers, $members);
        // }
        // return $allMembers;
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

    public function destroy(Team $team)
    {
        // Delete logic here

        $this->authorize('editProject', $team);

        return redirect()->route('dashboard')->with('success', 'Project deleted successfully.');
    }
    public function view()
    {
        $projects = Project::all();
        return view('projects-view', compact('projects'));
    }

    public function getMembers($teamId)
    {
        // Fetch members for the selected team
        $team = Team::findOrFail($teamId);
        $members = json_decode($team->members, true);

        return response()->json($members);
    }
}
