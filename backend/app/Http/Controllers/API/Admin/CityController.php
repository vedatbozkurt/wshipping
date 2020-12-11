<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CityRequest;

class CityController extends Controller
{
    public function index()
    {
        $city = City::orderBy('id', 'desc')->paginate(10);
        return response($city);
    }

    public function store(CityRequest $request)
    {
        $input = $request->validated();
        City::create($input);
        return response()->json('success');
    }

    public function update(CityRequest $request, City $city)
    {
        $input = $request->validated();
        $city->update($input);
        return response()->json('success');
    }

    public function destroy(City $city)
    {
        $city->delete();
        return response()->json('success');
    }
}
