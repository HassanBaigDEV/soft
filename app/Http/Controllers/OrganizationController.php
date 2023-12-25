<?php
// app/Http/Controllers/OrganizationController.php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use App\Models\Team;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrganizationController extends Controller
{
    public function create()
    {
        return view('organizations.create');
    }

    public function store(Request $request)

    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],

            // Add other validation rules as needed
        ]);


        // Retrieve validated data
        $name = $validatedData['name'];

        $user = auth()->user();
        // Set the organization owner ID
        $ownerId = $user->id;
        //generate invite code uuid
        $invite_code = \Illuminate\Support\Str::uuid();
        //add owner to members
        $organization = Organization::create([
            'name' => $name,
            'invite_code' => $invite_code,
            'owner_id' => $ownerId,
            'members' => json_encode(['1' => ['id' => $ownerId, 'name' => $user->name],])
        ]);



        // Create the organization
        if ($organization) {
            return redirect()->back()->with("success", "organization created successfully");
        } else {
            return redirect()->back()->with("error", "organization not created");
        }
    }


    public function edit($organizationId)

    {
        $organization = Organization::findOrFail($organizationId);
        return view('organizations-edit', compact('organization'));
    }

    public function update(Request $request, $organizationId)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'members' => 'array',
            'members.*' => 'exists:users,id',
            'invite_code' => 'required|string|max:255',
        ]);

        // Find the organization
        $organization = Organization::findOrFail($organizationId);

        // Update organization details
        $organization->name = $request->input('name');
        $organization->invite_code = $request->input('invite_code');

        // Update organization members
        $members = $request->input('members', []);
        $organization->members = $this->updateMembers($organization->members, $members);

        // Save the changes
        $organization->save();

        // Redirect back or to a specific route
        return redirect()->route('organizations.view')->with('success', 'Organization updated successfully');
    }


    private function updateMembers($existingMembers, $newMembers)
    {
        $existingMembers = json_decode($existingMembers, true);

        // Remove members not included in the new list
        $existingMembers = array_filter($existingMembers, function ($member) use ($newMembers) {
            return in_array($member['id'], $newMembers);
        });

        // Add new members to the list
        $usersToAdd = User::whereIn('id', $newMembers)->get(['id', 'name'])->toArray();

        foreach ($usersToAdd as $user) {
            $existingMembers[] = ['id' => $user['id'], 'name' => $user['name']];
        }

        // Encode the updated members array back to JSON
        return json_encode($existingMembers);
    }

    public function destroy(Organization $organization)
    {
        // Delete the organization
        // Remove related teams
        $teamIds = Team::where('organization_id', $organization->id)->pluck('id');
        Project::whereIn('team_id', $teamIds)->delete();
        Team::where('organization_id', $organization->id)->delete();

        // Get team IDs for further use

        // Remove related projects

        // Delete the organization
        $organization->delete();


        return redirect()->route('dashboard')->with('success', 'Organization deleted successfully.');
    }
    public function view(Organization $organization)
    {
        $user = auth()->user();
        $allOrganizations = Organization::all();

        $organizations = [];
        foreach ($allOrganizations as $org) {
            $orgMembers = json_decode($org->members, true);


            // Check if the user is a member of the team
            $isUserMember = collect($orgMembers)->contains(function ($member) use ($user) {
                return $member['id'] === $user->id;
            });

            if ($isUserMember) {

                // Filter team members based on user ID
                $filteredMembers = collect($orgMembers)->filter(function ($member) use ($user) {
                    return $member['id'] === $user->id;
                })->values()->toArray();

                $org->filteredMembers = $filteredMembers;
                $organizations[] = $org;
            }
        };
        return view('organizations-view', compact('organizations'));
    }
    public function join(Request $request, Organization $organization)
    {

        $user = auth()->user();
        $allOrganizations = Organization::all();

        // Validate invite code
        $attributes = $request->validate([
            'invite_code' => 'required|uuid',
        ]);


        // Search for organization with invite code
        foreach ($allOrganizations as $org) {
            if ($org->invite_code === $attributes['invite_code']) {
                $orgMembers = json_decode($org->members, true);


                // Check if the user is a member of the team
                $isUserMember = collect($orgMembers)->contains(function ($member) use ($user) {
                    return $member['id'] === $user->id;
                });


                if (!$isUserMember) {

                    // Add the user to the team
                    $orgMembers[] = [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                    ];

                    // Update the team members
                    $org->members = json_encode($orgMembers);
                    $org->save();

                    return redirect()->back()->with('success', 'You have successfully joined the organization.');
                } else {
                    // User is already a member
                    return redirect()->back()->withErors(['message' => 'You are already a member of this organization.']);
                }
            }
        }

        // No organization found with the given invite code
        return redirect()->back()->withErrors(['message' => 'Invalid invitation code. Please check and try again.']);
    }

    public function addMember(Request $request, $organizationId)
    {
        $organization = Organization::findOrFail($organizationId);

        // Validate the incoming member data
        $request->validate([
            'memberId' => 'required|integer',
        ]);

        $newMemberId = $request->input('memberId');

        // Check if the member is not already part of the organization
        $orgMembers = json_decode($organization->members, true);
        if (!collect($orgMembers)->contains('id', $newMemberId)) {
            // Add the new member to the organization
            $user = User::findOrFail($newMemberId);
            $newMember = [
                'id' => $user->id,
                'name' => $user->name, // You should replace this with actual logic to get member name
            ];

            $orgMembers[] = $newMember;
            $organization->members = json_encode($orgMembers);
            $organization->save();

            return response()->json(['message' => 'Member added successfully']);
        }

        return response()->json(['error' => 'Member is already part of the organization']);
    }



    // Method to remove a member from an organization
    public function removeMember(Request $request, $organizationId, $memberId)
    {
        $organization = Organization::findOrFail($organizationId);
        $orgMembers = json_decode($organization->members, true);

        // Find the index of the member to remove
        $indexToRemove = array_search($memberId, array_column($orgMembers, 'id'));

        if ($indexToRemove !== false) {
            // Remove the member from the organization
            unset($orgMembers[$indexToRemove]);
            $organization->members = json_encode(array_values($orgMembers));
            $organization->save();

            // Remove the member from all teams related to this organization
            Team::where('organization_id', $organizationId)->get()->each(function ($team) use ($memberId) {
                $team->members = array_values(array_filter($team->members, function ($member) use ($memberId) {
                    return $member['id'] != $memberId;
                }));
                $team->save();
            });

            // Remove the member from all projects related to the teams
            Project::whereIn('team_id', Team::where('organization_id', $organizationId)->pluck('id'))->get()->each(function ($project) use ($memberId) {
                $project->members = array_values(array_filter($project->members, function ($member) use ($memberId) {
                    return $member['id'] != $memberId;
                }));
                $project->save();
            });

            return response()->json(['message' => 'Member removed successfully']);
        }

        return response()->json(['error' => 'Member not found in the organization']);
    }
}
