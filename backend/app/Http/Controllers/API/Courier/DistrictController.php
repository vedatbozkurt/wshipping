<?php

namespace App\Http\Controllers\API\Courier;

use App\Http\Controllers\Controller;

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
}
