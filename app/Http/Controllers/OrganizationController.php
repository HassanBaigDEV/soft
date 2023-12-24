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
            'owner_id' => ['required', ''],
            // Add other validation rules as needed
        ]);

        // Retrieve validated data
        $name = $validatedData['name'];

        // Set the organization owner ID
        $ownerId = $validatedData['owner_id'];

        // Create the organization
        return DB::unprepared("Insert into organizations (name, owner_id) values ('$name','$ownerId')");

        // return Organization::create([
        //     'name' => $name,
        //     'owner_id' => $ownerId,
        //     // Add other fields as needed
        // ]);

        // return redirect()->route('dashboard')->with('success', 'Organization created successfully.');
    }


    public function edit(Organization $organization)
    {
        return view('organizations.edit', compact('organization'));
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
}
