<?php

namespace App\Http\Controllers\API\Courier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\CourierRequest;
use App\Courier;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(CourierRequest $request)
    {
        $input = $request->validated();
        $input['password'] = bcrypt($input['password']);
        $courier = Courier::create($input);
        $courier->city()->attach($request->city);
        $courier->district()->attach($request->district);
        return response()->json('success');
    }

    public function login(Request $request)
    {
     $email = $request->input('email');
     $password = $request->input('password');

     $user = Courier::where('email', '=', $email)->first();
     if (!$user) {
        return response()->json(['success'=>false, 'message' => 'Login Fail, please check email']);
    }
    if (!Hash::check($password, $user->password)) {
        return response()->json(['success'=>false, 'message' => 'Login Fail, please check password']);
    }
    if(!$user->status){
        return response()->json(['success'=>false, 'message' => 'Login Fail, your membership is not yet approved']);
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
        $userid = Auth::user()->id;

        $input = $request->validated();
        if(!empty($input['password'])){
            $input['password'] = bcrypt($input['password']);
        }
        $courier = Courier::whereId($userid)->update($input);
        $courier->city()->sync($request->city);
        $courier->district()->sync($request->district);
        return response()->json('success');
    }
}
