<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

            if ($existingUser) {
                Auth::login($existingUser);

            } else {
                $newUser = User::create([
                    'username' => $user->name,
                    'email' => $user->email,
                    'password' => encrypt('my-google'),
                    'google_id' => $user->id,
                    'created_at' => now(),
                ]);

                Auth::login($newUser);
            }
            session(['user_id' => $existingUser->id]);
            /**session(['google_id' => $user->id]);
            session(['google_loggedin' => true]);*/
            session(['logged' => true]);
            return redirect('/');

        } catch (\Exception $e) {

            return redirect('/login')->with('error', 'Something went wrong or you have cancelled the login.' . $e->getMessage());
        }
    }
}
