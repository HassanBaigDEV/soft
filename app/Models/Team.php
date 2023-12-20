<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'team_head',
        // Additional Fields
        'members',
        'projects',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function head()
    {
        return $this->belongsTo(\App\Models\User::class, 'team_head');
    }

    // Define relationships for members and projects if stored as JSON arrays
}
