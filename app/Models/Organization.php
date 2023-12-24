<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


use Illuminate\Database\Eloquent\Model;


class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'name',
        // Additional Fields
        'members',
        'invite_code',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Define relationships for members, teams, and projects if stored as JSON arrays

    // Create a new organization
    public static function createOrganization($attributes)
    {
        return self::create($attributes);
    }

    // Update an existing organization
    public function updateOrganization($attributes)
    {
        $this->update($attributes);
        return $this;
    }

    // Delete an organization
    public function deleteOrganization()
    {
        $this->delete();
    }

    // Get all organizations
    public static function getAllOrganizations()
    {
        return self::all();
    }

    // Get a specific organization by ID
    public static function getOrganizationById($organizationId)
    {
        return self::findOrFail($organizationId);
    }

    // Define relationships for members, teams, and projects if stored as JSON arrays

}
