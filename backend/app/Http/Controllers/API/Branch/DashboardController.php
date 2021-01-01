<?php

namespace App\Http\Controllers\API\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function show()
    {
        $branch = Auth::user();

        $city = $branch->city()->count(); //cities

        $districts = $branch->district; //districts
        $courier = []; // district couriers
        $user = [];
        $task = [];

        foreach ($districts as $district) {
            array_push($courier,$district->courier);
            array_push($user, $district->users);
            array_push($task, $district->tasks);
        }
        $couriers=collect($courier)->flatten();
        $courier = $couriers->sortByDesc('id')->unique('id')->count();
        $users=collect($user)->flatten();
        $user = $users->sortByDesc('id')->unique('id')->count();
        $tasks=collect($task)->flatten();
        $task = $tasks->sortByDesc('id')->unique('id')->count();

        return response()->json(['city' => $city,'courier' => $courier,'user' => $user,'task' => $task]);
    }

    public function initialdata()
    {
        // $flight = App\Flight::where('number', 'FR 900')->first();
        $initialdata = \App\Setting::select('currency','logo')->where('id', 1)->first();
        return response()->json($initialdata);
    }
}
