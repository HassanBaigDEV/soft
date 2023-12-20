<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


use Illuminate\Database\Eloquent\Model;


class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        // Additional Fields
        'members',
        'teams',
        'projects',
    ];

    public function owner()
    {
        return $this->belongsTo(\App\Models\User::class, 'owner_id');
    }

    // Define relationships for members, teams, and projects if stored as JSON arrays

}
