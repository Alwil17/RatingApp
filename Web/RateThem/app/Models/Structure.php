<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Structure extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'address',
        'tel1',
        'tel2',
        'horaires',
        'user_id',
    ];
}
