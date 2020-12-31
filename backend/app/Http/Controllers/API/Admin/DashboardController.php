<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class DashboardController extends Controller
{
    public function show()
    {
        $branch=\App\Branch::withTrashed()->count();
        $courier=\App\Courier::withTrashed()->count();
        $user=\App\User::withTrashed()->count();
        $task=\App\Task::withTrashed()->count();

        /*$income=Payment::get()->sum('price');
        $expense=Expense::get()->sum('price');
        $tasks = Task::orderBy('created_at','desc')->limit(5)->get();
        $events = Event::orderBy('created_at','desc')->limit(5)->get();*/
/*
        $i=1;
        $months = array();
        while($i <= 12) {
        $month=DB::table('companies')->whereMonth('created_at', '=', $i)->get()->count();
        array_push($months, $month);
            $i++;
        }*/
        return response()->json(['branch' => $branch,'courier' => $courier,'user' => $user,'task' => $task]);
    }
}
