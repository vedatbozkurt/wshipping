<?php

namespace App\Http\Controllers\API\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Address;
use App\Http\Requests\Api\AddressRequest;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index(Request $request){
       $districts=collect(Auth::user()->district)->pluck('id');
        $address = \App\Address::with('city:id,name','district:id,name','user:id,name')->whereIn('district_id',$districts)->orderBy('id', 'desc')->paginate(10);
        return response()->json($address);
    }

    public function store(AddressRequest $srequest)
    {
        //select olarak şubenin il, ilçe ve userlarını göster
        $form_data = array(
            'user_id'       =>   $request->user['id'],
            'city_id'       =>   $request->city['id'],
            'district_id'       =>   $request->district['id'],
            'name'       =>   $request->name,
            'description'       =>   $request->description,
            'default'       =>   $request->default
        );
        Address::create($form_data);
        return response()->json('success');
    }

    public function edit($address)
    {
        abort_unless(\Gate::allows('branch-own-address',$address), 403);
        $address = Address::with('city','district','user')->findOrFail($address);
        return response()->json($address);
    }

    public function update(AddressRequest $request, Address $address)
    {
        abort_unless(\Gate::allows('branch-own-address',$address->id), 403);
        $form_data = array(
            'user_id'       =>   $request->user['id'],
            'city_id'       =>   $request->city['id'],
            'district_id'       =>   $request->district['id'],
            'name'       =>   $request->name,
            'description'       =>   $request->description,
            'default'       =>   $request->default
        );
        $address->update($form_data);
        return response()->json('success');
    }

    public function destroy(Address $address)
    {
        abort_unless(\Gate::allows('branch-own-address',$address->id), 403);
        $address->delete();
        return response()->json('success');
    }
}
