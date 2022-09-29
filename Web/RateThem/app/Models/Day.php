<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $fillable = ['nom', 'slug'];

    public $timestamps = false;

    public function structures()
    {
        return $this->belongsToMany(Structure::class, 'workhours')->withPivot('id', 'start_time', 'end_time');
    }
}
