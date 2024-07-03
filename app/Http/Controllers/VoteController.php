<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;
use App\Models\User;

class VoteController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'filmID' => 'required|integer',
                'rating' => 'required|numeric|min:0|max:5',
            ]);

            $userId = session()->get('user_id');
            if (!$userId) {
                throw new \Exception('User session not found or expired');
            }

            $existingVote = Vote::where('utenteID', $userId)
                ->where('filmID', $validated['filmID'])
                ->first();

            if ($existingVote) {

                Vote::where('utenteID', $userId)
                    ->where('filmID', $validated['filmID'])
                    ->update(['rating' => $validated['rating']]);


                return response()->json(['success' => true, 'message' => 'Voto aggiornato con successo', 'vote' => $existingVote], 200);
            } else {

                $vote = Vote::create([
                    'utenteID' => $userId,
                    'filmID' => $validated['filmID'],
                    'rating' => $validated['rating'],
                ]);
            }


            return response()->json(['success' => true, 'vote' => $vote], 201);
        } catch (\Exception $e) {



            return response()->json(['success' => false, 'error' => 'Errore interno del server'], 500);
        }
    }

    public function getTop3()
    {
        $id = session('user_id');

        if (!$id) {
            return response()->json(['error' => 'User ID not found in session'], 404);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $topVotes = Vote::where('utenteID', $id)
            ->orderBy("rating", "desc")
            ->limit(3)
            ->get(["filmID", "rating"]);


        return response()->json($topVotes);
    }
}



