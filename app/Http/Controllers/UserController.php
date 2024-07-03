<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Activity;
use App\Http\Controllers\AuthController;

class UserController extends Controller
{
    public function getUser()
    {
        $id = session('user_id');

        if (!$id) {
            return response()->json(['error' => 'User ID not found in session'], 404);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }



        return response()->json($user);
    }

    public function updateImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');


            $imageName = time() . '_' . $image->getClientOriginalName();


            $id = session('user_id');

            if (!$id) {
                return response()->json(['error' => 'User ID not found in session'], 404);
            }

            $user = User::find($id);

            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            $destinationPath = public_path('Images/profiles');
            $image->move($destinationPath, $imageName);
            $user->image = $imageName;

            $user->save();

            $descrizione = "Immagine aggiornata";
            $dettagli = 'L immagine del profilo è stata aggiornata con:  ' . $imageName . now()->toDateTimeString();

            Activity::addActivity($descrizione, $dettagli);

            return response()->json(['message' => 'Immagine aggiornata con successo', 'imageName' => $imageName]);

        }
        return response()->json(['error' => 'Nessun file ricevuto'], 400);
    }

    public function updateUsername($value)
    {


        $userbyname = User::find($value);

        if ($userbyname) {
            return response()->json(['error' => 'Utente già presente'], 404);
        }

        $id = session('user_id');

        if (!$id) {
            return response()->json(['error' => 'User ID not found in session'], 404);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $descrizione = "Username aggiornato";
        $dettagli = 'Il nome utente è stato aggiornato in ' . now()->toDateTimeString();

        Activity::addActivity($descrizione, $dettagli);

        $user->username = $value;
        $user->save();
        return response()->json(['message' => 'Username aggiornato']);

    }

    public function delete()
    {

        $id = session("user_id");
        if (!$id) {
            return response()->json(['error' => 'User ID not found in session'], 404);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message', 'Account Eliminato']);

    }

    public function getTopActiveUsers()
    {
        $topUsers = User::select('utente.username', 'utente.image', DB::raw('COUNT(Vote.utenteID) + COUNT(Commento.utente_id) AS activities_count'))
            ->leftJoin('Vote', 'utente.id', '=', 'Vote.utenteID')
            ->leftJoin('Commento', 'utente.id', '=', 'Commento.utente_id')
            ->groupBy('utente.username', 'utente.image')
            ->orderByDesc('activities_count')
            ->limit(3)
            ->get();

        return response()->json($topUsers);
    }
}
