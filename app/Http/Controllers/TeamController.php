<?php

// app/Http/Controllers/TeamController.php
namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function create(Organization $organization)
    {
        $user = auth()->user();
        $organizations = Organization::where('owner_id', $user->id)->get();
        $members = User::all();

        return view('teams-create', compact('organizations', 'members'));
    }

    // public function store(Request $request)
    // {
       
    //     $attributes = $request->validate([
    //         'name' => ['required', 'max:255'],
    //         'organization_id' => ['required'],
    //         'members' => ['required'],
    //         'team_head' => ['required'],
    //         // Add other validation rules as needed
    //     ]);

    //     // // Convert members to an array of objects
    //     // $members = collect($attributes['members'])->map(function ($memberId) {
    //     //     $user = User::find($memberId);
    //     //     return [
    //     //         'id' => $user->id,
    //     //         'name' => $user->name,
    //     //         // Add other user attributes as needed
    //     //     ];
    //     // })->values();
    //     $authenticatedUser = Auth::user();
    //     $members = json_decode($attributes['members'], true) ?? [];

    //     // Check if the authenticated user is already in the members array
    //     $existingUserIndex = collect($members)->search(function ($member) use ($authenticatedUser) {
    //         return $member['id'] === $authenticatedUser->id;
    //     });

    //     if ($existingUserIndex === false) {
    //         // Add the authenticated user to the members array
    //         $members[$authenticatedUser->id] = [
    //             'id' => $authenticatedUser->id,
    //             'name' => $authenticatedUser->name,
    //         ];
    //     }
    //     $teamHeadUser= User::findOrFail($attributes['team_head']);

    //     // Encode the members array
    //     $attributes['members'] = json_encode($members);



    //     // Create a new Team instance and set its attributes
    //     $team = new Team([
    //         'name' => $attributes['name'],
    //         'organization_id' => $attributes['organization_id'],
    //         'members' => $attributes['members'] ,
    //         'team_head' => $attributes['team_head'],
    //     ]);

    //     // Save the team to the database
    //     $team->save();

    //     return redirect()->route('teams.view')->with('success', 'Team created successfully.');
    // }
    public function store(Request $request)
{
    $attributes = $request->validate([
        'name' => ['required', 'max:255'],
        'organization_id' => ['required'],
        'members' => ['required'],
        'team_head' => ['required'],
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

    // Check if the team head user is already in the members array
    $existingTeamHeadIndex = collect($members)->search(function ($member) use ($attributes) {
        return $member['id'] === $attributes['team_head'];
    });

    $teamHeadUser = User::findOrFail($attributes['team_head']);

    if ($existingTeamHeadIndex === false) {
        // Add the team head user to the members array
        $members[$teamHeadUser->id] = [
            'id' => $teamHeadUser->id,
            'name' => $teamHeadUser->name,
        ];
    }

    // Encode the members array
    $attributes['members'] = json_encode($members);

    // Create a new Team instance and set its attributes
    $team = new Team([
        'name' => $attributes['name'],
        'organization_id' => $attributes['organization_id'],
        'members' => $attributes['members'],
        'team_head' => $attributes['team_head'],
    ]);

    // Save the team to the database
    $team->save();

    return redirect()->route('teams.view')->with('success', 'Team created successfully.');
}




    public function edit($id)
    {
        $team = DB::table('teams')->find($id); // Assuming you have a Team model
        $orgId= $team->organization_id;

        $organization = Organization::findOrFail($orgId);
        $members = json_decode($organization->members, true);

        return view('teams-edit', compact('team', 'organization', 'members'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'organization_id' => 'required|exists:organizations,id',
            'members' => 'required|array',
            'members.*' => 'exists:members,id',
            'team_head' => 'required|exists:members,id',
        ]);

        $teamData = [
            'organization_id' => $request->input('organization_id'),
            'team_head' => $request->input('team_head'),
            'name' => $request->input('name'),
            'members' => json_encode(array_fill_keys($request->input('members'), [])),
            'updated_at' => now(),
        ];

        DB::table('teams')->where('id', $id)->update($teamData);

        return redirect()->route('teams.index')->with('success', 'Team updated successfully.');
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
