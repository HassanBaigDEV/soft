<?php
// app/Http/Controllers/OrganizationController.php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function create()
    {
        return view('organizations.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'max:255'],
            // Add other validation rules as needed
        ]);

        $attributes['owner_id'] = auth()->id(); // Set the organization owner ID

        $organization = Organization::create($attributes);

        return redirect()->route('dashboard')->with('success', 'Organization created successfully.');
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
}
