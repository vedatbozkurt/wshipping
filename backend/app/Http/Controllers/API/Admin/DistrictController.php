<?php

namespace App\Http\Controllers\API\Admin;

use App\District;
use App\Address;
use App\Task;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DistrictRequest;

class DistrictController extends Controller
{
    public function index()
    {
        $district = District::orderBy('id', 'desc')->paginate(10);
        return response($district);
    }

    public function store(DistrictRequest $request)
    {
        $input = $request->validated();
        District::create($input);
        return response()->json('success');
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

    public function couriers(District $district)
    {
        $courier = $district->courier()->orderBy('id', 'desc')->paginate(10);
        return response($courier);
    }

    public function branches(District $district)
    {
        $branch = $district->branch()->orderBy('id', 'desc')->paginate(10);
        return response($branch);
    }

    public function users(District $district)
    {
        /*$user = Address::with('user:id,name','district:id,name')->where('district_id', $district)->orderBy('id', 'desc')->paginate(10);*/

        $user = $district->users()->orderBy('id', 'desc')->paginate(10);
        return response($user);
    }

    public function tasks(District $district)
    {
        /*$task =  Task::with(['senderaddress' => function ($q) use ($district) {
            $q->where('district_id', $district);
        }])->orderBy('id', 'desc')->paginate(10);*/
        $task =  $district->tasks()->orderBy('id', 'desc')->paginate(10);
        return response($task);
    }
}
