<?php

namespace App\Http\Controllers\API\Admin;

use App\Setting;
use App\Http\Requests\Api\SettingRequest;
use App\Http\Controllers\Controller;
use File;

class SettingController extends Controller
{
    public function initialdata()
    {
        // $flight = App\Flight::where('number', 'FR 900')->first();
        $initialdata = Setting::select('currency','logo')->where('id', 1)->first();
        return response()->json($initialdata);
    }

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
        $image_name = $request->previous_image;
        $image = $request->file('image');
        if($image != '')
        {
          $image_path = "images/".$image_name;
          if(($image_name != 'no-image.png') && (File::exists($image_path))) {
            File::delete($image_path);
        }
        $image_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $image_name);
    }

    $form_data = array(
       'company_name'       =>   $request->company_name,
       'phone'        =>   $request->phone,
       'email'        =>   $request->email,
       'description'        =>   $request->description,
       'keywords'        =>   $request->keywords,
       'address'        =>   $request->address,
       'currency'        =>   $request->currency,
       'logo'       =>   $image_name,

   );

    $setting = Setting::where('id', 1)->first();
    $setting->update($form_data);
    return response()->json($form_data);
}
}
