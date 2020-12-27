<?php

namespace App\Http\Controllers\API\Admin;

use App\District;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DistrictRequest;
use Illuminate\Http\Request;

class DistrictController extends Controller
{

    public function getAdminDistricts(Request $request)
    {
        $request=collect($request)->pluck('id');
        $request=$request->flatten();
        $districts = \App\District::whereIn('city_id',$request)->get();
        //
        return response()->json($districts);
    }

    public function index()
    {
        $district = District::orderBy('id', 'desc')->paginate(10);
        return response()->json($district);
    }

    public function store(DistrictRequest $request)
    {
        $input = $request->validated();
        District::create($input);
        return response()->json('success');
    }

    public function edit(District $district)
    {
        return response()->json($district);
    }

    public function update(DistrictRequest $request, District $district)
    {
        $input = $request->validated();
        $district->update($input);
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
