<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $hidden = ['deleted_at'];

    public function schedules()
    {
        return $this->belongsToMany(Schedule::class);
    }
}
