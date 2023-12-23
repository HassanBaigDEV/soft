<?php

namespace App\Policies;

use App\Models\Team;
use Illuminate\Support\Facades\Auth;

class TeamPolicy
{
    
    public function editProject(Team $team)
    {
        $user = Auth::user();
        return $user->id === $team->team_head || $user->id === $team->organization->owner_id;
    }
    
}
