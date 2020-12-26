<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Address;
use App\Http\Requests\Api\AddressRequest;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index(){
        $addresses = \App\Address::with('city','district')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
        return response()->json($addresses);
    }

    public function store(AddressRequest $request)
    {
        //select olarak tüm il, ilçe
        $input = $request->validated();
        Address::create($input);
        return response()->json('success');
    }

    public function edit(Address $address)
    {
        abort_unless(\Gate::allows('user-own-address',$address->id), 403);
        return response()->json($address);
    }
    public function update(AddressRequest $request, Address $address)
    {
        abort_unless(\Gate::allows('user-own-address',$address->id), 403);
        $input = $request->validated();
        $address->update($input);
        return response()->json('success');
    }

    public function destroy(Address $address)
    {
        abort_unless(\Gate::allows('user-own-address',$address->id), 403);
        $address->delete();
        return response()->json('success');
    }
}
