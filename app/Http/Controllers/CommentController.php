<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commento;

class CommentController extends Controller
{
    public function getComments(Request $request)
    {
        $filmID = $request->input('film_id');


        $comments = Commento::select('testo', 'utente.username', 'utente.image', 'data_commento')
            ->join('utente', 'Commento.utente_id', '=', 'utente.id')
            ->where('Commento.film_id', $filmID)
            ->get();


        return response()->json($comments);
    }


    public function sendComment(Request $request)
    {

        $request->validate([
            'commento' => 'required|string',
            'film_id' => 'required|integer|exists:Film,id',
        ]);


        Commento::create([
            'film_id' => $request->input('film_id'),
            'utente_id' => session('user_id'),
            'testo' => $request->input('commento'),
            'data_commento' => now(),
        ]);




        return redirect()->back()->with('success', 'Commento aggiunto con successo!');
    }

}
