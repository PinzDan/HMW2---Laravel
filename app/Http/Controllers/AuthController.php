<?php


namespace App\Http\Controllers;

use App;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Mail\ConfirmationEmail;

class AuthController extends Controller
{

    /*[ REGISTRAZIONE ]*/


    public function register(Request $request)
    {
        // Validazione dei dati inseriti dall'utente
        $request->validate([
            'username' => 'required|unique:utente,username',
            'mail' => 'required|email|unique:utente,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required|same:password',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            // Generazione di un codice di conferma
            $confirmationCode = Str::random(30);

            // Salvataggio dell'immagine del profilo
            if ($request->hasFile('photo')) {
                $profile_image = $request->file('photo');
                $image_name = $profile_image->getClientOriginalName();
                $destinationPath = public_path('Images/profiles');
                $profile_image->move($destinationPath, $image_name);
            } else {
                $image_name = "Profile.png"; // o fornisci un percorso di immagine predefinito
            }

            // Creazione dell'utente nel database
            $user = User::create([
                'username' => $request->username,
                'email' => $request->mail,
                'password' => Hash::make($request->password),
                'image' => $image_name,
                'created_at' => Carbon::now(),
            ]);

            // Invio dell'email di conferma
            Mail::to($user->email)->send(new ConfirmationEmail($user, $confirmationCode));

            // Reindirizzamento con messaggio di successo
            return redirect()->route('login')->with('success', 'Registrazione completata. Controlla la tua email per confermare.');

        } catch (\Exception $e) {
            // Gestione degli errori
            return back()->withErrors(['error' => 'Si è verificato un errore durante la registrazione. Riprova più tardi.']);
        }
    }

    public function verify($code, $username)
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            // Se l'utente non esiste, reindirizza indietro con un errore
            return redirect()->back()->withErrors(['error' => 'Credenziali non valide']);
        }

        $verifica = User::where('username', $username)->update(['confirmation_code' => $code]);

        return redirect()->route('verifyComplete');


    }




    /*[ lOGIN ]*/

    public function login(Request $request)
    {
        // Validazione dei dati del form
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);


        $user = User::where('username', $credentials['username'])->first();

        if (!$user) {

            return redirect()->back()->withErrors(['error' => 'Credenziali non valide']);
        }


        if (password_verify($credentials['password'], $user->password) && $user->confirmation_code != null) {
            // Autenticazione riuscita

            session(['username' => $user->username]);
            session(['user_id' => $user->id]);
            session(['logged' => true]);
            if ($user->id == 1)
                session(['admin' => true]);

            $activities = [];

            Activity::fillArray(4, $activities);
            Session::put('activities', $activities);
            /* gestione activity */
            // Primo elemento: login effettuato

            $description = 'login';
            $details = 'Login effettuato in ' . Carbon::now()->toDateTimeString();
            Activity::addActivity($description, $details);



            return redirect()->route('home');
        } else {
            // Password non corretta, reindirizza indietro con un errore
            return redirect()->back()->withErrors(['error' => 'Credenziali non valide']);
        }
    }





    /* [ LOGOUT ] */
    public function logout(Request $request)
    {

        Session::flush();
        return redirect('/');
    }
}
