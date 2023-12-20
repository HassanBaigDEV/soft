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
        $this->authorize('editProject', $team);
        // Fetch user's teams to populate team dropdown
        $teams = auth()->user()->teams;

        return view('projects.create', compact('teams'));
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
}
