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

    //kurye şubeye aitse düzenlenebilir
    public function edit(Courier $courier)
    {
        $courier = $this->checkBranchCourier($courier->id);  //kurye şubeninse dburdan devam
        return response()->json($courier);
    }

    public function update(CourierRequest $request, Courier $courier)
    {
        $courier = $this->checkBranchCourier($courier->id); //kurye şubeninse dburdan devam
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
        $courier = $this->checkBranchCourier($courier->id); //kurye şubeninse dburdan devam
        $courier->delete();
        return response()->json('success');
    }


    public function tasks($courier) //kuryenin sorumlu olduğu illerdeki şubeler
    {
        $this->checkBranchCourier($courier);
        $tasks = Courier::with('task')->where('id', $courier)->orderBy('id', 'desc')->paginate(10);
     // $tasks = $courier->task()->orderBy('id', 'desc')->paginate(10);
        return response($tasks);
    }

    public function checkBranchCourier($courierid) //kuryenin sorumlu olduğu illerdeki şubeler
    {
        $districts = Auth::user()->district;
        $couriers=[];
        foreach ($districts as $district) {
            array_push($couriers,$district->courier);
        }
        $couriers=collect($couriers)->flatten();
        $couriers = $couriers->unique('id');
        $couriers = $couriers->pluck('id'); //sadece id leri çek
        $courier = Courier::with('city','district')->whereIn('id', $couriers)->findOrFail($courierid);
        return $courier;
    }

}
