<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commento extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'Commento';

    protected $fillable = [
        'film_id',
        'utente_id',
        'testo',
        'data_commento'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'utente_id');
    }

    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id');
    }
}
