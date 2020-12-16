<?php

namespace App\Http\Controllers\API\Admin;

use App\District;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DistrictRequest;

class DistrictController extends Controller
{
    public function index()
    {
        $district = District::orderBy('id', 'desc')->paginate(10);
        return response($district);
    }

    public function store(DistrictRequest $request)
    {
        $input = $request->validated();
        District::create($input);
        return response()->json('success');
    }

    public function update(DistrictRequest $request, District $district)
    {
        $input = $request->validated();
        $district->update($input);
        return response()->json('success');
    }

    public function destroy(District $district)
    {
        $district->delete();
        return response()->json('success');
    }
}
