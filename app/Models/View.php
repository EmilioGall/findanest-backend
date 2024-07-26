<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'house_id',
        'view_date' // Aggiunto il campo view_date
    ];

    // Definisce la relazione con il modello House
    public function house()
    {
        return $this->belongsTo(House::class);
    }
}
