<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leads extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'email',
        'phone_number',
        'message',

    ];

    public function house()
    {

        return $this->belongsTo(User::class);

    }

}
