<?php

namespace App\Http\Controllers\API\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\BranchRequest;
use App\Branch;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
     $email = $request->input('email');
     $password = $request->input('password');

     $user = Branch::where('email', '=', $email)->first();
     if (!$user) {
        return response()->json(['success'=>false, 'message' => 'Login Fail, please check email']);
    }
    if (!Hash::check($password, $user->password)) {
        return response()->json(['success'=>false, 'message' => 'Login Fail, please check password']);
    }
    if(!$user->status){
        return response()->json(['success'=>false, 'message' => 'Login Fail, your membership is not yet approved']);
    }
    $success['token'] =  $user->createToken('MyApp', ['branch'])->accessToken;
    $success['name'] =  $user->name;

    return response()->json(['status'=> 'success', 'data' => $success, 'message' => 'User login successfully.']);
}


public function getProfile()
{
    // $user = Auth::user()->id;
    // sadece il ve ilçelerini görür, değiştirmeyi sadece admin yapıyor
    $user = Auth::user();
    $branch = \App\Branch::with('city','district')->findOrFail($user->id);
    return response()->json($branch);
}

public function updateProfile(BranchRequest $request)
{
    // $user = Auth::user()->token();
    $userid = Auth::user()->id;

    $input = $request->validated();
    if(!empty($input['password'])){
        $input['password'] = bcrypt($input['password']);
    }
    Branch::whereId($userid)->update($input);
    return response()->json('success');
}
}
