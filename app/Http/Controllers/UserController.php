<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use App\Models\Organization;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function search(Request $request)
    {
        $query = $request->input('query');

        $users = User::where('name', 'like', "%{$query}%")
            ->select('id', 'name')
            ->get();

        return response()->json($users);
    }

    public function dashboard()
    {
        $user = auth()->user();
        $allProjects = Project::all();
        $projects = [];

        foreach ($allProjects as $project) {
            $projectMembers = json_decode($project->members, true);

            // Make sure $projectMembers is an array
            if (is_array($projectMembers)) {
                // Check if the user is a member of the project
                $isUserMember = collect($projectMembers)->contains(function ($member) use ($user) {
                    return is_array($member) && isset($member['id']) && $member['id'] === $user->id;
                });

                if ($isUserMember) {
                    // Filter project members based on user ID
                    $filteredMembers = collect($projectMembers)->filter(function ($member) use ($user) {
                        return is_array($member) && isset($member['id']) && $member['id'] === $user->id;
                    })->values()->toArray();

                    $project->filteredMembers = $filteredMembers;
                    $projects[] = $project;
                }
            }
        }
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
        $allTasks = Task::all();
        $tasks = [];


        foreach ($allTasks as $task) {
            $taskAssigned = $task->assigned_to;
            if ($taskAssigned) {
                if ($user->id === $taskAssigned) {

                    $tasks[] = $task;
                }
            }
        }


        $organizationsCount = count($organizations);
        $projectsCount = count($projects);
        $teamsCount = count($teams);
        $tasksCount = count($tasks);

        // filter projects based on status 
        $projectCompleteCount = 0;
        $projectInProgressCount = 0;
        $projectCompletedCount = 0;
        $projectNotStarted = 0;
        $projectCancelledCount = 0;
        foreach ($projects as $project) {
            if ($project->status === 'completed') {
                $projectCompleteCount++;
            }
            if ($project->status === 'in progress') {
                $projectInProgressCount++;
            }
            if ($project->status === 'not started') {
                $projectNotStarted++;
            }
            if ($project->status === 'cancelled') {
                $projectCancelledCount++;
            }
        }
        // filter tasks based on status the same way

        $taskInProgressCount = 0;
        $taskCompletedCount = 0;
        $taskNotStarted = 0;
        $taskCancelledCount = 0;

        foreach ($tasks as $task) {
            if ($task->status === 'completed') {
                $taskCompletedCount++;
            }
            if ($task->status === 'in progress') {
                $taskInProgressCount++;
            }
            if ($task->status ===  'not started') {
                $taskNotStarted++;
            }
            if ($task->status === 'cancelled') {
                $taskCancelledCount++;
            }
        }


        //pass the variables to the view

        return view('dashboard', compact('projects', 'projectCompleteCount', 'projectInProgressCount', 'organizationsCount', 'projectNotStarted', 'projectCancelledCount', 'teamsCount', 'projectsCount', 'tasks', 'taskInProgressCount', 'taskCompletedCount', 'taskNotStarted', 'taskCancelledCount', 'tasksCount', 'projectCompleteCount',));






        // return view('dashboard', compact('projects', 'projectCompleteCount', 'projectInProgressCount', 'organizationsCount', 'projectNotStarted', 'projectCancelledCount', 'teamsCount', 'projectsCount'));
    }
}
