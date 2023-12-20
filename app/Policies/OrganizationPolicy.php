<?php

// app/Policies/OrganizationPolicy.php

namespace App\Policies;

use App\Models\User;
use App\Models\Organization;

class OrganizationPolicy
{
    public function createTeam(User $user, Organization $organization)
    {
        return $user->id === $organization->owner_id;
    }
}
