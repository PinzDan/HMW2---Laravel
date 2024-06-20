<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('home');
})->name('home');



Route::get('/archive', function () {
    return view('archives');
})->name('archive');

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

    // Ora puoi utilizzare questi valori come necessario
    // Ad esempio, passarli alla vista per visualizzarli

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



Route::get('/fetch-regista', function (Request $request) {
    if ($request->has('regista_id')) {
        $regista_id = $request->input('regista_id');
        $regista = DB::select('SELECT * FROM Regista WHERE id = ?', [$regista_id]);

        return response()->json($regista);
    } else {
        return response()->json(['error' => 'Regista ID non fornito'], 400);
    }
});

Route::get('/get-comments', function (Request $request) {
    $filmID = $request->input('film_id');


    $comments = DB::table('Commento')
        ->select('testo', 'username')
        ->join('utente', 'Commento.utente_id', '=', 'utente.id')
        ->where('Commento.film_id', $filmID)
        ->get();

    // Ritorna i commenti in formato JSON
    return response()->json($comments);
});

Route::post('/send-comment', function (Request $request) {
    $request->validate([
        'commento' => 'required|string',
        'film_id' => 'required|integer|exists:Film,id',
    ]);

    $table = [
        'film_id' => $request->input('film_id'),
        'utente_id' => session('user_id'),
        'testo' => $request->input('commento'),
        'data_commento' => now(),

    ];

    DB::table('Commento')->insert($table);
    return redirect()->back()->with('success', 'Commento aggiunto con successo!');

})->name('send-comment');


Route::post('register', [AuthController::class, 'register']);



Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/login', function () {
    return view('Login'); // Assicura che 'Login' sia il nome corretto della tua vista
});
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


