<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
        'beds',
        'sqm',
        'latitude',
        'longitude',
        'image',
        'visible',
        'slug',
        'user_id',
        'sponsored',
        'services'

    ];

    ///// Relations /////
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
        return $this->belongsToMany(Sponsorship::class)->withPivot('expire_date');
    }


    public function views()
    {

        return $this->hasMany(View::class);
    }

    public function services()
    {

        return $this->belongsToMany(Service::class);
    }

    ///// Query scopes /////
    public function scopeByCurUser($query)
    {

        return $query->where('user_id', '=', Auth::id());
    }
}
