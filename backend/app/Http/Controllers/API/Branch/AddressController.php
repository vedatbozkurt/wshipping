<?php

namespace App\Http\Controllers\API\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Address;
use App\Http\Requests\Api\AddressRequest;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index(){
        $districts = Auth::user()->district;
        $addresses=[];
        foreach ($districts as $district) {
            array_push($addresses,$district->address);
        }
        $addresses=collect($addresses)->flatten();
        $addresses = $addresses->unique('id');
        return response($addresses);
    }
    public function store(AddressRequest $request)
    {
        //select olarak şubenin il, ilçe ve userlarını göster
        $input = $request->validated();
        Address::create($input);
        return response()->json('success');
    }

    public function edit(Address $address)
    {
        abort_unless(\Gate::allows('branch-own-address',$address->id), 403);
        return response()->json($address);
    }

    public function update(AddressRequest $request, Address $address)
    {
        abort_unless(\Gate::allows('branch-own-address',$address->id), 403);
        $input = $request->validated();
        $address->update($input);
        return response()->json('success');
    }

    public function destroy(Address $address)
    {
        abort_unless(\Gate::allows('branch-own-address',$address->id), 403);
        $address->delete();
        return response()->json('success');
    }
}
