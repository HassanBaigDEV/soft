<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Team;

class TeamPolicy
{
    public function editProject(User $user, Team $team)
    {
        return $user->id === $team->team_head || $user->id === $team->organization->owner_id;
    }
    
}
