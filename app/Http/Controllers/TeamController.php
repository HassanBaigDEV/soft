<?php

// app/Http/Controllers/TeamController.php
namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function create(Organization $organization)
    {
        // $this->middleware('role:owner');
        // Fetch user's organizations to populate organization dropdown
        $this->authorize('createTeam', $organization);
        $organizations = auth()->user()->organizations;

        return view('teams.create', compact('organizations'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'max:255'],
            'organization_id' => ['required', 'exists:organizations,id'],
            // Add other validation rules as needed
        ]);

        $team = Team::create($attributes);

        return redirect()->route('dashboard')->with('success', 'Team created successfully.');
    }
    public function edit(Team $team)
    {
        return view('teams.edit', compact('team'));
    }

    public function update(Request $request, Organization $organization)
    {
        // Validation and update logic here
        $this->authorize('createTeam', $organization);
        $organizations = auth()->user()->organizations;



        return redirect()->route('dashboard')->with('success', 'Team updated successfully.');
    }

    public function destroy(Organization $organization)
    {
        // Delete logic here
        $this->authorize('createTeam', $organization);
        $organizations = auth()->user()->organizations;


        return redirect()->route('dashboard')->with('success', 'Team deleted successfully.');
    }
}
