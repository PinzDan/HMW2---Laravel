<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regista extends Model
{
    use HasFactory;


    protected $table = "Regista";
    protected $fillable = [
        'nome',
        'cognome',
        'data_di_nascita',
        'luogo_di_nascita',
        'biografia',
        'foto',
    ];
}
