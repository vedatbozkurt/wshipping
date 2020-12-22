<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\UserRequest;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(UserRequest $request)
    {
        $input = $request->validated();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        return response()->json('success');
    }
    public function login(Request $request)
    {
     $email = $request->input('email');
     $password = $request->input('password');

     $user = User::where('email', '=', $email)->first();
     if (!$user) {
        return response()->json(['success'=>false, 'message' => 'Login Fail, please check email']);
    }
    if (!Hash::check($password, $user->password)) {
        return response()->json(['success'=>false, 'message' => 'Login Fail, please check password']);
    }
    if(!$user->status){
        return response()->json(['success'=>false, 'message' => 'Login Fail, your membership is not yet approved']);
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
}
