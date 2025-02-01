<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'description', 'deadline', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function teamMembers()
    {
        return $this->belongsToMany(TeamMember::class, 'project_team_member')->withPivot('role');;
    }
}
