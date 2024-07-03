<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;



class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();

            $existingUser = User::where('email', $user->email)->first();

            $activities = [];
            Activity::fillArray(4, $activities);
            Session::put('activities', $activities);
            /* gestione activity */
            // Primo elemento: login effettuato

            $description = 'login';
            $details = 'Login effettuato con Google ' . Carbon::now()->toDateTimeString();
            Activity::addActivity($description, $details);



            if ($existingUser) {

                session(['user_id' => $existingUser->id]);

            } else {


                $newUser = User::create([
                    'username' => $user->name,
                    'email' => $user->email,
                    'password' => encrypt('my-google'),
                    'google_id' => $user->id,
                    'image' => "Profile.png",
                    'created_at' => now(),
                ]);


                session(['user_id' => $newUser->id]);

            }

            /**session(['google_id' => $user->id]);
            session(['google_loggedin' => true]);*/
            session(['logged' => true]);
            return redirect('/');

        } catch (\Exception $e) {

            return redirect('/login')->with('error', 'Something went wrong or you have cancelled the login.' . $e->getMessage());
        }
    }
}
