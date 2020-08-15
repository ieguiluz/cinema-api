<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public $timestamps = false;

    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }
}