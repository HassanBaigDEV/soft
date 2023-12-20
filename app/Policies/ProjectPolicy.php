<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;

class ProjectPolicy
{
    public function manageTasks(User $user, Project $project)
    {
        return $user->id === $project->team->team_head || $user->id === $project->team->organization->owner_id;
    }
}
