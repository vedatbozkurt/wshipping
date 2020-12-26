<?php

namespace App\Http\Controllers\API\Admin;

use App\Setting;
use App\Http\Requests\Api\SettingRequest;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function edit()
    {
        // $flight = App\Flight::where('number', 'FR 900')->first();
        $setting = Setting::where('id', 1)->first();
        return response()->json($setting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request)
    {
        $input = $request->validated();
        $setting = Setting::where('id', 1)->first();
        $setting->update($input);
        return response()->json('success');
    }
}
