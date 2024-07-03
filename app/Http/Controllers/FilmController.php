<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Regista;


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

    public function countAwardsByFilmId($id)
    {

        $filmId = $id;



        $awardsCount = DB::table('Premio')
            ->select('nome', DB::raw('COUNT(*) as total'))
            ->where('filmID', $filmId)
            ->groupBy('nome')
            ->get();

        // Passa i dati alla view
        return response()->json($awardsCount);
    }


    public function getById($filmID)
    {


        $film = Film::find($filmID);

        // Controlla se il film esiste
        if (!$film) {
            return response()->json(['error' => 'Film not found'], 404);
        }


        return response()->json($film);
    }



    public function addFilm(Request $request)
    {


        $request->validate([
            'Title' => 'required|string',
            'Year' => 'required|string',
            'Genre' => 'required|string',
            'Runtime' => 'required|string',
            'Director' => 'required|string',
            'Actors' => 'required|string',
            'Plot' => 'required|string',
        ]);


        $nominativoRegista = explode(' ', trim($request->input('Director')));
        $nome = $nominativoRegista[0];
        $cognome = isset($nominativoRegista[1]) ? $nominativoRegista[1] : null;
        $regista_id = Regista::where("nome", $nome)->where('cognome', $cognome)->value('id');


        $film = new Film();
        if ($regista_id != null) {
            $film->regista_id = $regista_id;
        }
        $film->title = $request->input('Title');
        $film->anno_di_rilascio = $request->input('Year');
        $film->genere = $request->input('Genre');
        $durata = (int) preg_replace('/[^0-9]/', '', $request->input('Runtime'));
        $film->durata = $durata;
        $film->cast = $request->input('Actors');
        $film->trama = $request->input('Plot');
        $path = 'assets/Images/locandine/nondisp.jpg';
        $film->locandina = $path;


        Log::info('Dati del film prima del salvataggio:', $film->toArray());


        $film->save();



        return response()->json(['message' => 'Film aggiunto con successo'], 200);


    }
}





