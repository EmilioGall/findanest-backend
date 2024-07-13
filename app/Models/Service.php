<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    // fillable property
    protected $fillable = [
        'service_name',
        'icon'
    ];

    public function houses()
    {
        return $this->belongsToMany(House::class);
    }
}
