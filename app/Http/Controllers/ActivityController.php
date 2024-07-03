<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;

class ActivityController extends Controller
{

    // Importa il modello Activity


    public function createActivity($description, $details)
    {
        $activity = new Activity($description, $details);

        return $activity;
    }

}
