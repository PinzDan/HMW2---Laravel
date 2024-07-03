<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;


class Activity
{
    public $description;
    public $details;

    public function __construct($description = "Nessun Attività", $details = "Vuoto")
    {
        $this->description = $description;
        $this->details = $details;
    }


    public static function addActivity($description, $details)
    {
        $activities = Session::get('activities', []);

        $act = new Activity($description, $details);
        array_unshift($activities, $act);


        if (count($activities) > 4) {
            array_pop($activities);
        }


        Session::put('activities', $activities);
    }

    public static function fillArray($i = 3, &$array)
    {
        $j = 0;
        for ($j; $j < $i; $j++) {
            $array[$j] = new Activity();
        }
    }

}


