<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class FilmController extends Controller
{
    public function index()
    {
        try {
            $films = Film::orderBy('title', 'asc')->get();
            return response()->json($films);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Errore durante il recupero dei film'], 500);
        }
    }

    public function countAwardsByFilmId(Request $request)
    {



        // Recupera l'id del film dalla richiesta
        $filmId = $request->input('id');



        // Conta il numero di premi raggruppati per nome del premio
        $awardsCount = DB::table('Premio')
            ->select('nome', DB::raw('COUNT(*) as total'))
            ->where('filmID', $filmId) // Filtra per filmId
            ->groupBy('nome')
            ->get();

        // Passa i dati alla view
        return response()->json($awardsCount);
    }



}

