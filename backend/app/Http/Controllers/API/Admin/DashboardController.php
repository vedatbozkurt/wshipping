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

        $i=1;
        $tasksmonth = array();
        $usersmonth = array();
        $couriersmonth = array();
        while($i <= 12) {
            $tasks=\App\Task::withTrashed()->whereMonth('created_at', '=', $i)->get()->count();
            array_push($tasksmonth, $tasks);
            $users=\App\User::withTrashed()->whereMonth('created_at', '=', $i)->get()->count();
            array_push($usersmonth, $users);
            $courier=\App\Courier::withTrashed()->whereMonth('created_at', '=', $i)->get()->count();
            array_push($couriersmonth, $courier);
            $i++;
        }


        return response()->json(['branch' => $branch,'courier' => $courier,'user' => $user,'task' => $task,'tasksmonth' => $tasksmonth,'usersmonth' => $usersmonth,'couriersmonth' => $couriersmonth]);
    }
}
