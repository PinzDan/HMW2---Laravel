<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;
    protected $table = "Vote";
    protected $primaryKey = 'filmID';
    public $incrementing = false;
    protected $fillable = ["utenteID", "filmID", "rating"];

    public $timestamps = false;


}
