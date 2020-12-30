<?php

namespace App\Http\Controllers\API\Admin;

use App\City;
use App\Address;
use App\Task;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CityRequest;

class CityController extends Controller
{

    public function getAllCities()
    {
        $cities = City::all();
        return response()->json($cities);
    }

    public function index()
    {
        $city = City::orderBy('id', 'desc')->paginate(10);
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
        $districts = $city->district()->orderBy('id', 'desc')->paginate(2); //City $city
        return response()->json($districts);
    }

    public function branches(City $city)
    {
        $branch = $city->branch()->orderBy('id', 'desc')->paginate(2); //City $city
        return response()->json($branch);
    }

    public function couriers(City $city)
    {
        $courier = $city->courier()->orderBy('id', 'desc')->paginate(2); //City $city
        return response()->json($courier);
    }

    public function users(City $city)
    {
        $user = $city->users()->orderBy('id', 'desc')->paginate(2); //City $city
        return response()->json($user);
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
