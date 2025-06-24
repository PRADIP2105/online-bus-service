<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = ['name', 'operator_id', 'capacity', 'image_path', 'type'];

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}