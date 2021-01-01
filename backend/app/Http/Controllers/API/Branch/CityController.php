<?php

namespace App\Http\Controllers\API\Branch;

use App\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{

    public function getAllCities()
    {
        $cities = Auth::user()->city;
        return response()->json($cities);
    }

}
