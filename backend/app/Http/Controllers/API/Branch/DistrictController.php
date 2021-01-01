<?php

namespace App\Http\Controllers\API\Branch;

use App\District;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DistrictController extends Controller
{

    public function getCitiesDistricts($cities) //citieslerin districtleri
    {
        $selectedcities = explode (",",$cities);
        $alldistricts = array();
        foreach ($selectedcities as $city) {
           $districts = \App\District::where('city_id',$city)->get();
           array_push($alldistricts, $districts);
       }
        $city=collect($alldistricts);
        $city=$city->flatten();
       return response()->json($city);
   }

    public function getCityDistricts($city) //city district
    {
        $districts = \App\District::where('city_id',$city)->get();
        return response()->json($districts);
    }

}
