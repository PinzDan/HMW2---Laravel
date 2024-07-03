<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

Route::view('/', 'home')->name('home');
Route::view('/archive', 'archives')->name('archive');
Route::view('/login', 'Login')->name('login');
Route::view('/verifyComplete', 'verifyComplete')->name('verifyComplete');
Route::view('/info', 'info')->name('info');
Route::view('/setting', 'setting')->name('setting');

Route::view('/resetForm', 'resetForm')->name('restore');
Route::view('/resetpwd/{id}', 'resetView')->name('reset');

// Route::get('/verify/{confirmationCode}/{username}', [AuthController::class, 'verify'])->name('verify.email');

Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('selected', function (Request $request) {
    // Estrai i parametri dall'oggetto Request
    $id = $request->input('id');
    $title = $request->input('title');
    $anno_di_rilascio = $request->input('anno_di_rilascio');
    $trama = $request->input('trama');
    $genere = $request->input('genere');
    $durata = $request->input('durata');
    $cast = $request->input('cast');
    $trailer = $request->input('trailer');
    $locandina = $request->input('locandina');
    $regista_id = $request->input('regista_id');
    $rating = $request->input('rating');

    return view('selected_film', [
        'id' => $id,
        'title' => $title,
        'anno_di_rilascio' => $anno_di_rilascio,
        'trama' => $trama,
        'genere' => $genere,
        'durata' => $durata,
        'cast' => $cast,
        'trailer' => $trailer,
        'locandina' => $locandina,
        'regista_id' => $regista_id,
        'rating' => $rating,
    ]);
})->name('selected');





// Route::post('register', [AuthController::class, 'register']);
// Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
// Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
// Route::post('/login', [AuthController::class, 'login'])->name('login');
// Route::post('register', [AuthController::class, 'register'])->name('register');






