<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        'organization_id',
        'team_head',
        // Additional Fields
        'members',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function head()
    {
        return $this->belongsTo(\App\Models\User::class, 'team_head');
    }

    // In Team.php

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    // Define relationships for members and projects if stored as JSON arrays
}
