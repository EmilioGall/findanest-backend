<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'address',
        'description',
        'rooms',
        'bathrooms',
        'sqm',
        'latitude',
        'longitude',
        'image',
        'visible',
        'slug',
        'user_id',
    ];
}
