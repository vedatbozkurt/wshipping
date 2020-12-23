<?php

namespace App\Http\Controllers\API\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Courier;
use App\Http\Requests\Api\CourierRequest;
use Illuminate\Support\Facades\Auth;

class CourierController extends Controller
{
    public function index()
    {
        // şubenin kuryeleri
        $districts = Auth::user()->district;
        $courier=[];
        foreach ($districts as $district) {
            array_push($courier,$district->courier);
        }
        $couriers=collect($courier)->flatten();
        $couriers = $couriers->unique('id');
        return response($couriers);
    }

    public function citycouriers()
    {
        // $courier = Auth::user()::with('city.courier')->orderBy('id', 'desc')->paginate(10);
        $courier = \App\Branch::with('city.courier')->where('id',Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
    // Courier::whereHas(‘branch’, ...)->whereHas(‘city’...)...
        return response($courier);
    }

    public function districtcouriers()
    {
        $courier = \App\Branch::with('district.courier')->where('id',Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
        return response($courier);
    }


    public function store(CourierRequest $request)
    {
        $input = $request->validated();
        $input['password'] = bcrypt($input['password']);
        $courier = Courier::create($input);
        $courier->city()->attach($request->city);
        $courier->district()->attach($request->district);

        return response()->json('success');
    }
    //kurye şubeye aitse düzenlenebilir
    public function edit(Courier $courier)
    {
        abort_unless(\Gate::allows('branch-own-couriers',$courier->id), 403);
        return response()->json($courier);
    }

    public function update(CourierRequest $request, Courier $courier)
    {
        abort_unless(\Gate::allows('branch-own-couriers',$courier->id), 403); //kurye şubeninse dburdan devam
        $input = $request->validated();
        if(!empty($input['password'])){
            $input['password'] = bcrypt($input['password']);
        }
        $courier->update($input);
        $courier->city()->sync($request->city);
        $courier->district()->sync($request->district);

        return response()->json('success');
    }

    public function destroy(Courier $courier) // soft delete
    {
        abort_unless(\Gate::allows('branch-own-couriers',$courier->id), 403); //kurye şubeninse dburdan devam
        $courier->delete();
        return response()->json('success');
    }


    public function tasks(Courier $courier) //kuryenin sorumlu olduğu illerdeki şubeler
    {
        abort_unless(\Gate::allows('branch-own-couriers',$courier->id), 403); //kurye şubeninse dburdan devam
        $tasks = Courier::with('task')->where('id', $courier->id)->orderBy('id', 'desc')->paginate(10);
     // $tasks = $courier->task()->orderBy('id', 'desc')->paginate(10);
        return response($tasks);
    }

}
