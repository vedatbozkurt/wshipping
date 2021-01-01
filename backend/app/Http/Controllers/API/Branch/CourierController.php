<?php

namespace App\Http\Controllers\API\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Courier;
use App\Http\Requests\Api\CourierRequest;
use Illuminate\Support\Facades\Auth;
use File;

class CourierController extends Controller
{
    public function index(Request $request)
    {
        // şubenin kuryeleri
        $branch = Auth::user();
        $districts = $branch->district;

        $courier = [];
        foreach ($districts as $district) {
            array_push($courier,$district->courier);
        }
        $couriers=collect($courier)->flatten();
        $couriers = $couriers->sortByDesc('id')->unique('id');
        $couriers= $couriers->flatten()->toArray();

        $page = isset($request->page) ? $request->page : 1;
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        $current_page_orders = array_slice($couriers, $offset, $perPage);
        $orders_to_show = new \Illuminate\Pagination\LengthAwarePaginator($current_page_orders, count($couriers), $perPage);
        $orders_to_show->setPath($request->url());
        return response()->json($orders_to_show);
    }
    public function allCouriers(Request $request) //şubenin sorumlu olduğu illerdeki kuryeler
    {
        $branch = Auth::user();
        $districts = $branch->district;

        $courier = [];
        foreach ($districts as $district) {
            array_push($courier,$district->courier);
        }
        $couriers=collect($courier)->flatten();
        $couriers = $couriers->sortByDesc('id')->unique('id');
        $couriers= $couriers->flatten();

        return response()->json($couriers);
    }

    public function store(CourierRequest $request)
    {
        $image_name='';
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

        return response()->json('success');
    }
    //kurye şubeye aitse düzenlenebilir
    public function edit($courier)
    {
        abort_unless(\Gate::allows('branch-own-couriers',$courier), 403);
        $courier = \App\Courier::with('city','district')->findOrFail($courier);
        return response()->json($courier);
    }

    public function update(CourierRequest $request, Courier $courier)
    {
        abort_unless(\Gate::allows('branch-own-couriers',$courier->id), 403); //kurye şubeninse dburdan devam
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

    public function destroy(Courier $courier) // soft delete
    {
        abort_unless(\Gate::allows('branch-own-couriers',$courier->id), 403); //kurye şubeninse dburdan devam
        $courier->delete();
        return response()->json('success');
    }


    public function tasks($courier) //kuryenin sorumlu olduğu illerdeki şubeler
    {
        abort_unless(\Gate::allows('branch-own-couriers',$courier), 403); //kurye şubeninse dburdan devam
        $tasks = \App\Task::with('sender:id,name,phone','receiver:id,name,phone')->where('courier_id',$courier)->orderBy('id', 'desc')->paginate(10);
        return response()->json($tasks);
    }

}
