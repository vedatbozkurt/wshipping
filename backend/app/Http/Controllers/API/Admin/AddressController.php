<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Address;
use App\Http\Requests\Api\AddressRequest;

class AddressController extends Controller
{
    public function index()
    {
        $address = Address::with('city:id,name','district:id,name','user:id,name,email')->orderBy('id', 'desc')->paginate(10);
        return response()->json($address);
    }

    public function store(AddressRequest $request)
    {
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
        $address = Address::with('city','district','user')->findOrFail($address);
        return response()->json($address);
    }

    public function update(AddressRequest $request, Address $address)
    {
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
        $address->delete();
        return response()->json('success');
    }
}
