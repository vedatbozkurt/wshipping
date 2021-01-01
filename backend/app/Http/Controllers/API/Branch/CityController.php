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

    public function getCities()
    {
        $cities = Auth::user()->city()->orderBy('id','desc')->paginate(10);;
        return response()->json($cities);
    }
    public function edit(City $city)
    {
        return response()->json($city);
    }

    public function couriers(City $city)
    {
        $courier = $city->courier()->orderBy('id', 'desc')->paginate(10); //City $city
        return response()->json($courier);
    }

    public function users(Request $request, City $city)
    {
        $users = $city->users;
        $users=collect($users)->flatten();
        $users = $users->sortByDesc('id')->unique('id');
        $users= $users->flatten()->toArray();

        $page = isset($request->page) ? $request->page : 1;
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        $current_page_orders = array_slice($users, $offset, $perPage);
        $orders_to_show = new \Illuminate\Pagination\LengthAwarePaginator($current_page_orders, count($users), $perPage);
        $orders_to_show->setPath($request->url());


        return response()->json($orders_to_show);
    }

    public function tasks($city)
    {
        /*$task =  Task::with(['senderaddress' => function ($q) use ($district) {
            $q->where('district_id', $district);
        }])->orderBy('id', 'desc')->paginate(10);*/
        $task = \App\Task::with('sender:id,name,phone','receiver:id,name,phone','senderaddress:id,city_id',)->whereHas("senderaddress",function($q) use($city){
            $q->where("city_id","=",$city);
        })->orderBy('id', 'desc')->paginate(10);
        return response()->json($task);
    }

}
