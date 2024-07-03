<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'Film';
    protected $fillable = [
        'title',
        'trama',
        'locandina',
        'trailer',
        'anno_di_rilascio',
        'rating',
        'durata',
        'genere',
        'cast'
    ];
}

