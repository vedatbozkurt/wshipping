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
        $city = City::orderBy('id', 'desc')->paginate(2);
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

    public function districts($city)
    {
        // $districts = City::find($city)->district;
        // $district = $city->district;   //City $city
        $district = \App\City::with('district')->where('id',$city)->orderBy('id', 'desc')->paginate(10);
        return response()->json($district);
    }

    public function branches($city)
    {
        // $branch = $city->branch()->orderBy('id', 'desc')->paginate(10);  //City $city
        $branch = \App\City::with('branch')->where('id',$city)->orderBy('id', 'desc')->paginate(10);
        return response()->json($branch);
    }

    public function couriers($city)
    {
        // $districts = City::find($city)->district;
        // $courier = $city->courier()->orderBy('id', 'desc')->paginate(10); //City $city
        $courier = \App\City::with('courier')->where('id',$city)->orderBy('id', 'desc')->paginate(10);
        return response()->json($courier);
    }

    public function users($city)
    {
        // $address = Address::select('id','user_id', 'city_id', 'name', 'description')->with('user:id,name','city:id,name')->where('city_id', $city)->orderBy('id', 'desc')->paginate(10);
        /*$user =  User::with(['address' => function ($q) use ($city) {
            $q->where('city_id', $city);
        }])->orderBy('id', 'desc')->paginate(10);
        return response($user);*/
        // $user = $city->users()->orderBy('id', 'desc')->paginate(10); //City $city
        $user = \App\City::with('users')->where('id',$city)->orderBy('id', 'desc')->paginate(10);
        return response()->json($user);
    }

    public function tasks($city)
    {
       /*$task = Task::with(['senderaddress' => $city, function ($query, $city) {
            $query->where('city_id','=', $city);
        }])->get();*/
        // $task =  $city->tasks()->orderBy('id', 'desc')->paginate(10); //City $city
        $task = \App\City::with('tasks')->where('id',$city)->orderBy('id', 'desc')->paginate(10);
        return response()->json($task);
    }

}
