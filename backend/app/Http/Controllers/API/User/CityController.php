<?php

namespace App\Http\Controllers\API\User;

use App\City;
use App\Http\Controllers\Controller;

class CityController extends Controller
{

    public function getAllCities()
    {
        $cities = City::all();
        return response()->json($cities);
    }


}
