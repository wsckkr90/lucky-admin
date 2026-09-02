<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'active' => 'boolean',
        ];
    }

    public function cities()
    {
        return $this->belongsToMany(
            City::class,
            'user_cities'
        )->withTimestamps();
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function roles()
{
    return $this->morphToMany(
        \Spatie\Permission\Models\Role::class,
        'model',
        'model_has_roles',
        'model_id',
        'role_id'
    );
}
}