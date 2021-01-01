<?php

namespace App\Http\Controllers\API\Courier;

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
