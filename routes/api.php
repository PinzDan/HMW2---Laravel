<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\VoteController;

/* film controller function */

Route::get('/films', [FilmController::class, 'index']);
Route::get('/films/awards-count', [FilmController::class, 'countAwardsByFilmId']);


/* vote controller function */
Route::get('/vote', [VoteController::class, 'store']);