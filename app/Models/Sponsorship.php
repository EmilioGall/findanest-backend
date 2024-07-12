<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    use HasFactory;

    protected $fillable = [

        'type_name',
        'type_duration',
        'price'

    ];

    public function houses()
    {

        return $this->belongsToMany(House::class);

    }

}
