<?php

// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use App;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthController extends Controller
{

    /*[ REGISTRAZIONE ]*/


    public function register(Request $request)
    {


        $request->validate([
            'username' => 'required|unique:utente,username',
            'mail' => 'required|email|unique:utente,email',
            'password' => 'required|confirmed',

        ]);


        // Verifica se 'pwd' e 'confirm_pwd' sono uguali
        if ($request->password !== $request->password_confirmation) {
            return redirect()->back()->withInput()->withErrors(['password_confirmation' => 'Le password non corrispondono.']);
        }

        $confirmationCode = Str::random(30);


        $user = User::create([
            'username' => $request->username,
            'email' => $request->mail,
            'password' => Hash::make($request->password),
            'confirmation_code' => $confirmationCode,
            'created_at' => Carbon::now(),

        ]);



        return redirect()->route('login')->with('success', 'Registrazione completata. Controlla la tua email per confermare.');
    }




    /*[ lOGIN ]*/

    public function login(Request $request)
    {
        // Validazione dei dati del form
        $credentials = $request->validate([
            'username' => 'required|string',
            'pwd' => 'required|string',
        ]);

        // Recupero dell'utente dal database
        $user = User::where('username', $credentials['username'])->first();

        if (!$user) {
            // Se l'utente non esiste, reindirizza indietro con un errore
            return redirect()->back()->withErrors(['error' => 'Credenziali non valide']);
        }

        // Verifica della password
        if (password_verify($credentials['pwd'], $user->password)) {
            // Autenticazione riuscita
            Auth::login($user);
            session(['username' => $user->username]);
            session(['user_id' => $user->id]);
            session(['logged' => true]);

            return redirect()->route('home');
        } else {
            // Password non corretta, reindirizza indietro con un errore
            return redirect()->back()->withErrors(['error' => 'Credenziali non valide']);
        }
    }





    /* [ LOGOUT ] */
    public function logout(Request $request)
    {
        Auth::logout(); // Logout dell'utente
        Session::flush(); // Elimina tutte le variabili di sessione
        return redirect('/'); // Reindirizza alla home o a una pagina di login
    }
}
