<?php

namespace App\Http\Controllers\API\Admin;

use App\District;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DistrictRequest;
use Illuminate\Http\Request;

class DistrictController extends Controller
{

    public function getCitiesDistricts(Request $request)
    {
        $request=collect($request)->pluck('id');
        $request=$request->flatten();
        $districts = \App\District::whereIn('city_id',$request)->get();
        //
        return response()->json($districts);
    }

    public function getCityDistricts($city)
    {
        $districts = \App\District::where('city_id',$city)->get();
        return response()->json($districts);
    }

    public function index()
    {
        $district = District::with('city')->orderBy('id', 'desc')->paginate(10);
        return response()->json($district);
    }

    public function store(DistrictRequest $request)
    {
        $form_data = array(
            'city_id'       =>   $request->city['id'],
            'name'       =>   $request->name
        );
        District::create($form_data);
        return response()->json('success');
    }

    public function edit(District $district)
    {
        // $district = $district->city;
        $district = \App\District::with('city')->findorFail($district->id);
        return response()->json($district);
    }

    public function update(DistrictRequest $request, District $district)
    {
        $form_data = array(
            'city_id'       =>   $request->city['id'],
            'name'       =>   $request->name
        );
        $district->update($form_data);
        return response()->json('success');
    }

    public function destroy(District $district)
    {
        $district->delete();
        return response()->json('success');
    }

    public function couriers($district)
    {
        $courier = \App\District::with('courier')->where('id',$district)->orderBy('id', 'desc')->paginate(10);
        return response()->json($courier);
    }

    public function branches($district)
    {
        $branch = \App\District::with('branch')->where('id',$district)->orderBy('id', 'desc')->paginate(10);
        return response()->json($branch);
    }

    public function users($district)
    {
        /*$user = Address::with('user:id,name','district:id,name')->where('district_id', $district)->orderBy('id', 'desc')->paginate(10);*/

        $user = \App\District::with('users')->where('id',$district)->orderBy('id', 'desc')->paginate(10);
        return response()->json($user);
    }

    public function tasks($district)
    {
        /*$task =  Task::with(['senderaddress' => function ($q) use ($district) {
            $q->where('district_id', $district);
        }])->orderBy('id', 'desc')->paginate(10);*/
        // $task =  $district->tasks()->orderBy('id', 'desc')->paginate(10);
        // $task = \App\District::with('tasks.courier')->where('id',$district)->orderBy('id', 'desc')->paginate(10);
        $task = \App\District::with('tasks')->where('id',$district)->orderBy('id', 'desc')->paginate(10);
        return response()->json($task);
    }
}
