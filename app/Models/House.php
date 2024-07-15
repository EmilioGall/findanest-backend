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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function sponsorships()
    {
        return $this->belongsToMany(Sponsorship::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
