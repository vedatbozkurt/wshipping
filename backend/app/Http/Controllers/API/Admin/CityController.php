<?php

namespace App\Http\Controllers\API\Admin;

use App\City;
use App\Address;
use App\Task;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CityRequest;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function getAllCities()
    {
        $cities = City::all();
        return response()->json($cities);
    }

    public function index(Request $request)
    {
        $city = City::orderBy('id', 'desc')->paginate(10);
        return response()->json($city);
    }

    public function search($search)
    {
        $city = City::search($search)->orderBy('id', 'desc')->paginate(10);
        return response()->json($city);
    }

    public function store(CityRequest $request)
    {
        $input = $request->validated();
        City::create($input);
        return response()->json('success');
    }

    public function edit(City $city)
    {
        return response()->json($city);
    }

    public function update(CityRequest $request, City $city)
    {
        $input = $request->validated();
        $city->update($input);
        return response()->json('success');
    }

    public function destroy(City $city)
    {
        $city->delete();
        return response()->json('success');
    }

    public function districts(City $city)
    {
        $districts = $city->district()->orderBy('id', 'desc')->paginate(10); //City $city
        return response()->json($districts);
    }

    public function branches(City $city)
    {
        $branch = $city->branch()->orderBy('id', 'desc')->paginate(10); //City $city
        return response()->json($branch);
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
