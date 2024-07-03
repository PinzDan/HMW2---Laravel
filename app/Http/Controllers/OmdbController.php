<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OmdbController extends Controller
{
    public function search($title)
    {
        $apiKey = env('OMDB_API_KEY');


        if (!$title) {
            return response()->json(['error' => 'Title is required'], 400);
        }

        $response = Http::get("http://www.omdbapi.com/?apikey={$apiKey}&t=" . $title);

        if ($response->successful()) {
            return response()->json($response->json());
        }


        return response()->json(['error' => 'Unable to fetch data from OMDb'], $response->status());
    }
}
