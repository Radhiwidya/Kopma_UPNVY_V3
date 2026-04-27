<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'no_anggota',
        'name',
        'username',
        'password',
        'user_type',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function isAdmin()
    {
        return $this->user_type === 'admin';
    }

    public function isUser()
    {
        return $this->user_type === 'user';
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function canAccess($section)
    {
        if ($this->role === 'ketua') {
            return true;
        }

        return $this->role === strtolower($section);
    }
}