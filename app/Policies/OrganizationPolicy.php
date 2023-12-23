<?php

// app/Policies/OrganizationPolicy.php

namespace App\Policies;

use App\Models\User;
use App\Models\Organization;

class OrganizationPolicy
{

    public function createTeam($user, Organization $organization)
    {
        // Check if the user is the owner of the specified organization
        return $organization->owner_id === $user->id;
    }
}
