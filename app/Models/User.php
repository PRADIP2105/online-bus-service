<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = ['name', 'email', 'password', 'role_id'];

    protected $hidden = ['password', 'remember_token'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin()
    {
        return $this->role_id === 1;
    }

    public function isOperator()
    {
        return $this->role_id === 2;
    }

    public function isPassenger()
    {
        return $this->role_id === 3;
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}