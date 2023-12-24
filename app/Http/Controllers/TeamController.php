<?php

// app/Http/Controllers/TeamController.php
namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    public function create(Organization $organization)
    {
        $user = auth()->user();
        $organizations = Organization::where('owner_id', $user->id)->get();
        $members = User::all();

        return view('teams-create', compact('organizations', 'members'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'max:255'],
            'organization_id' => ['required', 'exists:organizations,id'],
            'members' => ['required', 'array'],
            'team_head' => ['required', 'exists:users,id'],
            // Add other validation rules as needed
        ]);

        // Convert members to an array of objects
        $members = collect($attributes['members'])->map(function ($memberId) {
            $user = User::find($memberId);
            return [
                'id' => $user->id,
                'name' => $user->name,
                // Add other user attributes as needed
            ];
        })->values();

        // Create a new Team instance and set its attributes
        $team = new Team([
            'name' => $attributes['name'],
            'organization_id' => $attributes['organization_id'],
            'members' => $members->toJson(),
            'team_head' => $attributes['team_head'],
        ]);

        // Save the team to the database
        $team->save();

        return redirect()->route('teams.view')->with('success', 'Team created successfully.');
    }



    public function edit(Team $team)
    {
        return view('teams.edit', compact('team'));
    }

    public function update(Request $request, Organization $organization)
    {
        // Validation and update logic here
        $organizations = auth()->user()->organizations;
        $this->authorize('createTeam', $organization);



        return redirect()->route('dashboard')->with('success', 'Team updated successfully.');
    }

    public function destroy(Organization $organization)
    {
        // Delete logic here
        $organizations = auth()->user()->organizations;
        $this->authorize('createTeam', $organization);


        return redirect()->route('dashboard')->with('success', 'Team deleted successfully.');
    }
    
    public function view(Team $team)
    {
        $user = auth()->user();
        $allTeams = Team::all();

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

        return view('teams-view', compact('teams'));
    }
}
