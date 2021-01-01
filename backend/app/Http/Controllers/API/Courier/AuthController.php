<?php

namespace App\Http\Controllers\API\Courier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\CourierRequest;
use App\Courier;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use File;

class AuthController extends Controller
{
    public function register(CourierRequest $request)
    {
        $image_name='no-image.png';
        $image = $request->file('image');
        if($image != '')
        {
            $image_name = rand(10000000,99999999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/courier'), $image_name);
        }

        $form_data = array(
            'name'        =>   $request->name,
            'phone'        =>   $request->phone,
            'email'        =>   $request->email,
            'vehicle'        =>   $request->vehicle,
            'plate'        =>   $request->plate,
            'color'        =>   $request->color,
            'password'        =>   bcrypt($request->password),
            'image'       =>   $image_name,
        );
        $courier = Courier::create($form_data);

        $city=json_decode($request->city);
        $city=collect($city)->pluck('id');
        $city=$city->flatten();
        $courier->city()->sync($city);

        $district=json_decode($request->district);
        $district=collect($district)->pluck('id');
        $district=$district->flatten();
        $courier->district()->sync($district);
        return response()->json('success');
    }

    public function login(Request $request)
    {
     $email = $request->input('email');
     $password = $request->input('password');

     $user = Courier::where('email', '=', $email)->first();
     if (!$user) {
        return response()->json(['errors' => ['email' => ['Login Fail, please check email']]], 422);
    }
    if (!Hash::check($password, $user->password)) {
        return response()->json(['errors' => ['password' => ['Login Fail, please check password']]], 422);
    }
    if(!$user->status){
        return response()->json(['errors' => ['notapproved' => ['Login Fail, your membership is not yet approved']]], 422);
    }
    $success['token'] =  $user->createToken('MyApp', ['courier'])->accessToken;
    $success['name'] =  $user->name;

    return response()->json(['status'=> 'success', 'data' => $success, 'message' => 'Login successfully.']);
}
public function getProfile()
{
        // $user = Auth::user()->id;
    $user = Auth::user();
    $courier = Courier::with('city','district')->findOrFail($user->id);
    return response()->json($courier);
}

public function updateProfile(CourierRequest $request)
{
        // $user = Auth::user()->token();
    $courier = Auth::user();

    $image_name = $request->previous_image;
    $image = $request->file('image');
    if($image != '')
    {
      $image_path = "images/courier/".$image_name;
      if(($image_name != 'no-image.png') && (File::exists($image_path))) {
        File::delete($image_path);
    }
    $image_name = rand() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('images/courier'), $image_name);
}

$form_data = array(
   'name'        =>   $request->name,
   'phone'        =>   $request->phone,
   'email'        =>   $request->email,
   'vehicle'        =>   $request->vehicle,
   'plate'        =>   $request->plate,
   'color'        =>   $request->color,
   'image'       =>   $image_name,
);
if(!empty($request['password'])){
  $form_data['password'] = bcrypt($request['password']);
}

$courier->update($form_data);

$city=json_decode($request->city);
$city=collect($city)->pluck('id');
$city=$city->flatten();
$courier->city()->sync($city);

$district=json_decode($request->district);
$district=collect($district)->pluck('id');
$district=$district->flatten();
$courier->district()->sync($district);

return response()->json(['status'=> 'success', 'data' => $courier, 'message' => 'Courier updated successfully.']);
}

public function logout(Request $request)
{
    Auth::user()->token()->revoke();
    return response()->json([
        'status' => 'success',
        'msg' => 'Logged out Successfully.'
    ], 200);
}
}
