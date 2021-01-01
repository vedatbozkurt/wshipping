<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\UserRequest;
use App\User;
use App\Address;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(UserRequest $request)
    {
        $image_name='no-image.png';
        $image = $request->file('image');
        if($image != '')
        {
            $image_name = rand(10000000,99999999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/user'), $image_name);
        }

        $form_data = array(
            'name'       =>   $request->name,
            'phone'        =>   $request->phone,
            'email'        =>   $request->email,
            'password'        =>   bcrypt($request->password),
            'image'       =>   $image_name,
        );

        $user = User::create($form_data);

        $address = array(
            'user_id'       =>   $user->id,
            'city_id'       =>   $request->city,
            'district_id'       =>   $request->district,
            'name'       =>   $request->addressname,
            'description'       =>   $request->description,
        );
        Address::create($address);
        return response()->json('success');
    }
    public function login(Request $request)
    {
       $email = $request->input('email');
       $password = $request->input('password');

       $user = User::where('email', '=', $email)->first();
       if (!$user) {
        return response()->json(['errors' => ['email' => ['Login Fail, please check email']]], 422);
    }
    if (!Hash::check($password, $user->password)) {
        return response()->json(['errors' => ['password' => ['Login Fail, please check password']]], 422);
    }
    if(!$user->status){
       return response()->json(['errors' => ['notapproved' => ['Login Fail, your membership is not yet approved']]], 422);
   }
   $success['token'] =  $user->createToken('MyApp', ['user'])->accessToken;
   $success['name'] =  $user->name;

   return response()->json(['status'=> 'success', 'data' => $success, 'message' => 'Login successfully.']);
}

public function getProfile()
{
        // $user = Auth::user()->id;
    $user = Auth::user();
    $user = User::findOrFail($user->id);
    return response()->json($user);
}

public function updateProfile(UserRequest $request)
{
        // $user = Auth::user()->token();
    $userid = Auth::user()->id;
    $input = $request->validated();
    if(!empty($input['password'])){
        $input['password'] = bcrypt($input['password']);
    }
    User::whereId($userid)->update($input);
    return response()->json('success');
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
