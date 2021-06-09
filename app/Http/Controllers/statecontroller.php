<?php

namespace App\Http\Controllers;
use  App\Models\State;

use Illuminate\Http\Request;

class statecontroller extends Controller
{
    function getAllState(){
        $state= state::all();
        return $state;
    }
}
