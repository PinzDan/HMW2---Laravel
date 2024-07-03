<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthResetPasswordController extends Controller
{



    public function sendResetMail(Request $request)
    {
        try {
            $validator = $request->validate([
                'email' => 'required|email'
            ]);


            $user = User::where('email', $request->email)->first();

            if ($user) {

                Mail::to($request->email)->send(new ResetPassword($user));
                return redirect()->back()->with('success', 'Email di reset password inviata con successo.');
            } else {
                return redirect()->back()->withErrors(['email' => 'Nessun utente trovato con questo indirizzo email.']);
            }

        } catch (\Exception $e) {


            return redirect()->back()->withErrors(['error' => 'Si è verificato un errore durante l\'invio dell\'email.' . $request->email]);
        }
    }


    function updatePassword(Request $request)
    {
        $validate = $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ],
            'id' => 'required|exists:utente,id'
        ]);

        $update = User::where('id', $request->id)
            ->update(['password' => Hash::make($request->password)]);

        if ($update)
            return redirect()->route('login')->with('success', 'password aggiornata');
    }
}
