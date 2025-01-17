<?php

namespace App\Http\Controllers\API\Admin;

use App\District;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DistrictRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class DistrictController extends Controller
{

    public function getCitiesDistricts($cities) //citieslerin districtleri
    {
        $selectedcities = explode (",",$cities);
        $alldistricts = array();
        foreach ($selectedcities as $city) {
           $districts = \App\District::where('city_id',$city)->get();
           array_push($alldistricts, $districts);
       }
        $city=collect($alldistricts);
        $city=$city->flatten();
       return response()->json($city);
   }

    public function getCityDistricts($city) //city district
    {
        $districts = \App\District::where('city_id',$city)->get();
        return response()->json($districts);
    }

    public function index()
    {
        $district = District::with('city')->orderBy('id', 'desc')->paginate(10);
        return response()->json($district);
    }

    public function search($search)
    {
        $district = \App\District::with('city')->whereHas("city",function($q) use($search){
            $q->where('name', 'like', '%'.$search.'%')->orWhere('id', 'like', '%'.$search.'%');
        })->orWhere('id', 'like', '%'.$search.'%')
        ->orWhere('name', 'like', '%'.$search.'%')
        ->orderBy('id', 'desc')->paginate(10);
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

    public function couriers(District $district)
    {
        // $courier = \App\District::with('courier')->where('id',$district)->orderBy('id', 'desc')->paginate(10);
        $courier = $district->courier()->orderBy('id', 'desc')->paginate(10);
        return response()->json($courier);
    }

    public function branches(District $district)
    {
        // $branch = \App\District::with('branch')->where('id',$district)->orderBy('id', 'desc')->paginate(10);
        $branch = $district->branch()->orderBy('id', 'desc')->paginate(10);
        return response()->json($branch);
    }

    public function users(Request $request, District $district)
    {
        /*$user = Address::with('user:id,name','district:id,name')->where('district_id', $district)->orderBy('id', 'desc')->paginate(10);*/

        // $user = \App\District::with('users')->where('id',$district)->orderBy('id', 'desc')->paginate(10);
        $user = $district->users;
        $users=collect($user)->flatten();
        $users = $users->sortByDesc('id')->unique('id');
        $users= $users->flatten()->toArray();

        $page = isset($request->page) ? $request->page : 1;
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        $current_page_orders = array_slice($users, $offset, $perPage);
        $orders_to_show = new \Illuminate\Pagination\LengthAwarePaginator($current_page_orders, count($users), $perPage);
        $orders_to_show->setPath($request->url());
        return response()->json($orders_to_show);
    }

    public function tasks($district)
    {
       $task = \App\Task::with('sender:id,name,phone','receiver:id,name,phone','senderaddress:id,district_id',)->whereHas("senderaddress",function($q) use($district){
        $q->where("district_id","=",$district);
    })->orderBy('id', 'desc')->paginate(10);
       return response()->json($task);
   }
}
