<?php

namespace App\Http\Controllers\API\Courier;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function initialdata()
    {
        // $flight = App\Flight::where('number', 'FR 900')->first();
        $initialdata = \App\Setting::select('currency','logo')->where('id', 1)->first();
        return response()->json($initialdata);
    }
    public function show()
    {
        $courier = Auth::user();
        $citynumber = $courier->city()->count(); //cities
        $districtsnumber = $courier->district()->count(); //districts

        $districts = $courier->district;
        $task = [];

        $task = \App\Task::where('courier_id', $courier->id)->count();
        return response()->json(['city' => $citynumber,'district' => $districtsnumber,'task' => $task]);
    }
}
