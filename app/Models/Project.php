<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'color',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workSessions()
    {
        return $this->hasMany(WorkSession::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
