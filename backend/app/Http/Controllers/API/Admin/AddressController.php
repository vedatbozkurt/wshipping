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
        return response($address);
    }

    public function store(AddressRequest $request)
    {
        $input = $request->validated();
        Address::create($input);
        return response()->json('success');
    }

    public function update(AddressRequest $request, Address $address)
    {
        $input = $request->validated();
        $address->update($input);
        return response()->json('success');
    }

    public function destroy(Address $address)
    {
        $address->delete();
        return response()->json('success');
    }
}
