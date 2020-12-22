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
        $courier = Courier::with('city','district','task')->orderBy('id', 'desc')->paginate(10);
        return response($courier);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourierRequest $request)
    {
        $input = $request->validated();
        $input['password'] = bcrypt($input['password']);
        $courier = Courier::create($input);
        $courier->city()->attach($request->city);
        $courier->district()->attach($request->district);

        return response()->json('success');
    }

    public function edit(Courier $courier)
    {
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
        $input = $request->validated();
        if(!empty($input['password'])){
            $input['password'] = bcrypt($input['password']);
        }
        $courier->update($input);
        $courier->city()->sync($request->city);
        $courier->district()->sync($request->district);

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

    // kuryenin çalıştıgı illerin şubeleri
    // kuryenin çalıştıgı ilde şube olmadığından şube boş gelmesi normal
    public function citybranches(Courier $courier) //kuryenin sorumlu olduğu illerdeki şubeler
    {
     $cities =  $courier->city()->orderBy('id', 'desc')->paginate(10);
     $cities->map(function ($city) {
        return $city->branch;
    });
     return response($cities);
 }
    // kuryenin çalıştıgı ilçelerin şubeleri
    // kuryenin çalıştıgı ilde şube olmadığından şube boş gelmesi normal
    public function districtbranches(Courier $courier) //kuryenin sorumlu olduğu illerdeki şubeler
    {
     // $courier = Courier::with('city','district')->orderBy('id', 'desc')->paginate(10);
     $districts =  $courier->district()->orderBy('id', 'desc')->paginate(10);
     $districts->map(function ($district) {
        return $district->branch;
    });
     return response($districts);
 }

    public function tasks($courier) //kuryenin sorumlu olduğu illerdeki şubeler
    {
     $tasks = Courier::with('task')->where('id', $courier)->orderBy('id', 'desc')->paginate(10);
     // $tasks = $courier->task()->orderBy('id', 'desc')->paginate(10);
     return response($tasks);
    }
}
