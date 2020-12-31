<?php

namespace App\Http\Controllers\API\Admin;

use App\Courier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CourierRequest;

class CourierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courier = Courier::withTrashed()->orderBy('id', 'desc')->paginate(10);
        // $courier = Courier::with('district.city')->orderBy('id', 'desc')->paginate(10);
        //no need to show tasks
        // $courier = Courier::with('district.city','task')->orderBy('id', 'desc')->paginate(10);
        return response()->json($courier);
    }

    public function search($search)
    {
        $courier = Courier::search($search)->orderBy('id', 'desc')->paginate(2);
        return response()->json($courier);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourierRequest $request)
    {
        $request['password'] = bcrypt($request['password']);
        $courier = Courier::create($request->all());

        $city=collect($request->city)->pluck('id');
        $city=$city->flatten();
        $courier->city()->sync($city);
        $district=collect($request->district)->pluck('id');
        $district=$district->flatten();
        $courier->district()->sync($district);
        return response()->json('success');
    }

    public function edit($courier)
    {
        $courier = \App\Courier::with('city','district')->withTrashed()->findOrFail($courier);
        return response()->json($courier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function update(CourierRequest $request, Courier $courier)
    {
        if(!empty($request['password'])){
            $request['password'] = bcrypt($request['password']);
        }
        $courier->update($request->all());

        $city=collect($request->city)->pluck('id');
        $city=$city->flatten();
        $courier->city()->sync($city);
        $district=collect($request->district)->pluck('id');
        $district=$district->flatten();
        $courier->district()->sync($district);

        return response()->json('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $courier = Courier::withTrashed()->find($id)->forceDelete();
        // return response()->json($courier);
        $courier = Courier::withTrashed()->find($id);
        $courier->city()->detach();
        $courier->district()->detach();
        $courier->forceDelete();
        return response()->json('success');
    }

    public function restore($id)
    {
        $courier = Courier::where('id',$id)->withTrashed()->first();
        $courier->restore();
        return response()->json('success');
    }


    public function getCourierCities($courier) //city e ait branchleri bulmak için gerekiyor
    {
       $cities =  Courier::find($courier)->city;
       // $cities = $cities->toArray();
       return response()->json($cities);
   }

 public function getCourierDistricts($courier) //district e ait branchleri bulmak için gerekiyor
 {
   $districts =  Courier::find($courier)->district;
   return response()->json($districts);
}

    // kuryenin çalıştıgı illerin şubeleri
    // kuryenin çalıştıgı ilde şube olmadığından şube boş gelmesi normal
    public function citybranches($city) //kuryenin sorumlu olduğu illerdeki şubeler
    {
        /*$cities = \App\Courier::with('city.branch')->where('id',$courier)->orderBy('id', 'desc')->paginate(10);
        return response()->json($cities);*/
        $branch = \App\City::findorFail($city)->branch()->orderBy('id', 'desc')->paginate(10);
        return response()->json($branch);
    }
    // kuryenin çalıştıgı ilçelerin şubeleri
    // kuryenin çalıştıgı ilde şube olmadığından şube boş gelmesi normal
    public function districtbranches($district) //kuryenin sorumlu olduğu illerdeki şubeler
    {
        $branch = \App\District::findorFail($district)->branch()->orderBy('id', 'desc')->paginate(10);
        return response()->json($branch);
    }

    public function tasks($courier) //kuryenin sorumlu olduğu illerdeki şubeler
    {
     // $tasks = $courier->task()->orderBy('id', 'desc')->paginate(10);
       $tasks = \App\Task::with('sender:id,name,phone','receiver:id,name,phone')->where('courier_id',$courier)->orderBy('id', 'desc')->paginate(10);
       return response()->json($tasks);
   }
}
