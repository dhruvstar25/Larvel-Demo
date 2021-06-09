<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\city;
use Illuminate\Support\Facades\DB;
class citycontroller extends Controller
{
    //
    function getCityByStateId($id){
        
        $dataCity = DB::table('citys')->where('stateid',$id)->get(["CityName","id"]);
        return $dataCity;
    }
}
