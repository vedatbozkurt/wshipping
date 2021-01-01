<?php

namespace App\Http\Controllers\API\User;

use App\District;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function getCityDistricts($city) //city district
    {
        $districts = District::where('city_id',$city)->get();
        return response()->json($districts);
    }
}
