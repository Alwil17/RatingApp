<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'type',
        'structure_id',
    ];

    public function structure(){
        return $this->belongsTo(Structure::class);
    }

    public function ratings(){
        return $this->hasMany(Rating::class);
    }
}
