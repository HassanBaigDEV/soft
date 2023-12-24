<?php
// app/Http/Controllers/OrganizationController.php

namespace App\Http\Controllers;

use App\Models\Organization;
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

    public function update(Request $request, Organization $organization)
    {
        // Validation and update logic here


        return redirect()->route('dashboard')->with('success', 'Organization updated successfully.');
    }

    public function destroy(Organization $organization)
    {
        // Delete logic here

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
        }
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
}
