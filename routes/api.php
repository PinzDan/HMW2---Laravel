<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthResetPasswordController;
use App\Http\Controllers\CommentController;
use App\Models\Regista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OmdbController;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');

Route::post('/login', [AuthController::class, 'login'])->name('api.login');
Route::post('register', [AuthController::class, 'register'])->name('api.register');

Route::get('/verify/{confirmationCode}/{username}', [AuthController::class, 'verify'])->name('verify.email');



Route::get("/getTop", [UserController::class, "getTopActiveUsers"]);

Route::get("/account", [UserController::class, 'getUser']);
Route::post("/updateImage", [UserController::class, 'updateImage']);
Route::get("/updateUsername/{value}", [UserController::class, 'updateUsername'])->where('value', '[a-zA-Z0-9]{5,10}');
Route::get("/deleteAccount", [UserController::class, 'delete']);


Route::get('/films', [FilmController::class, 'index']);
Route::get('/films/awards-count/{filmId}', [FilmController::class, 'countAwardsByFilmId'])->where('filmID', '[0-9]+');
Route::get('/getByID/{filmID}', [FilmController::class, 'getById'])->where('filmID', '[0-9]+');
Route::get('/films/addFilm', [FilmController::class, 'addFilm']);


Route::get('/get-comments', [CommentController::class, 'getComments']);
Route::post('/send-comment', [CommentController::class, 'sendComment'])->name('send-comment');


Route::get('/vote', [VoteController::class, 'store']);
Route::get('/topVotes', [VoteController::class, 'getTop3']);


Route::get('/omdb/{title}', [OmdbController::class, 'search']);

/* regista */
Route::get('/fetch-regista/{registaId}', function ($regista_id) {
    if ($regista_id) {
        $regista = Regista::find($regista_id);

        return response()->json($regista);
    } else {
        return response()->json(['error' => 'Regista ID non fornito'], 400);
    }
});

Route::post('resetSubmit', [AuthResetPasswordController::class, 'sendResetMail'])->name('password.email');
Route::post('updatePassword', [AuthResetPasswordController::class, 'updatePassword'])->name('updatePassword');
