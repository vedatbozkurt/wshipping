<?php

namespace App\Http\Controllers\API\Admin;

use App\Courier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CourierRequest;
use File;

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
        $image_name='no-image.png';
        $image = $request->file('image');
        if($image != '')
        {
            $image_name = rand(10000000,99999999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/courier'), $image_name);
        }

        $form_data = array(
            'name'        =>   $request->name,
            'phone'        =>   $request->phone,
            'email'        =>   $request->email,
            'vehicle'        =>   $request->vehicle,
            'plate'        =>   $request->plate,
            'color'        =>   $request->color,
            'password'        =>   bcrypt($request->password),
            'image'       =>   $image_name,
        );
        if(!empty($request['status'])){
            $form_data['status'] = ($request['status']);
        }
        $courier = Courier::create($form_data);

        $city=json_decode($request->city);
        $city=collect($city)->pluck('id');
        $city=$city->flatten();
        $courier->city()->sync($city);

        $district=json_decode($request->district);
        $district=collect($district)->pluck('id');
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
        $image_name = $request->previous_image;
        $image = $request->file('image');
        if($image != '')
        {
          $image_path = "images/courier/".$image_name;
          if(($image_name != 'no-image.png') && (File::exists($image_path))) {
            File::delete($image_path);
        }
        $image_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/courier'), $image_name);
    }

    $form_data = array(
       'name'        =>   $request->name,
       'phone'        =>   $request->phone,
       'email'        =>   $request->email,
       'vehicle'        =>   $request->vehicle,
       'plate'        =>   $request->plate,
       'color'        =>   $request->color,
       'status'        =>   $request->status,
       'image'       =>   $image_name,
   );
    if(!empty($request['password'])){
      $form_data['password'] = bcrypt($request['password']);
  }

  $courier->update($form_data);

  $city=json_decode($request->city);
  $city=collect($city)->pluck('id');
  $city=$city->flatten();
  $courier->city()->sync($city);

  $district=json_decode($request->district);
  $district=collect($district)->pluck('id');
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
