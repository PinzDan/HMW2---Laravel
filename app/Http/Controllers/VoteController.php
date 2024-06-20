<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;


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
                // Se esiste già un voto, aggiorna il rating
                Vote::where('utenteID', $userId)
                    ->where('filmID', $validated['filmID'])
                    ->update(['rating' => $validated['rating']]);

                // Rispondi con successo
                return response()->json(['success' => true, 'message' => 'Voto aggiornato con successo', 'vote' => $existingVote], 200);
            } else {
                // Altrimenti, crea un nuovo voto
                $vote = Vote::create([
                    'utenteID' => $userId,
                    'filmID' => $validated['filmID'],
                    'rating' => $validated['rating'],
                ]);
            }

            // Rispondi con successo
            return response()->json(['success' => true, 'vote' => $vote], 201);
        } catch (\Exception $e) {
            // Log dell'errore
            \Log::error('Error in VoteController@store: ' . $e->getMessage());

            // Risposta di errore generica
            return response()->json(['success' => false, 'error' => 'Errore interno del server'], 500);
        }
    }
}



