<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $table = 'Film';
    protected $fillable = [
        'title',
        'description',
        'locandina',
        'trailer',
        'anno_di_rilascio',
        'rating',
        'durata',
        'genere'
    ];
}

