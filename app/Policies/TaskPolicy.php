<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Task;

class TaskPolicy
{
    public function updateTask(User $user, Task $task)
    {
        return $user->id === $task->assigned_to || $user->id === $task->project->team->team_head || $user->id === $task->project->team->organization->owner_id;
    }

    public function deleteTask(User $user, Task $task)
    {
        return $user->id === $task->project->team->team_head || $user->id === $task->project->team->organization->owner_id;
    }

   
}
