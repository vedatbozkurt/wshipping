<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\AdminRequest;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(AdminRequest $request)
    {
        $input = $request->validated();
        $input['password'] = bcrypt($input['password']);
        $user = Admin::create($input);
        $success['token'] =  $user->createToken($user->name)->accessToken;
        $success['name'] =  $user->name;

        activity()
        ->causedBy($user) //yapan kişi:admin -- buraya giriş yapmış adminin auth bilgisini ekle
        ->performedOn($user) //yapılan işlem:task created
        ->withProperties(['action' => 'register', 'status' => 'success', 'user' => $user->name])
        ->log('new registration');

        return response()->json(['status'=> 'success', 'data' => $success, 'message' => 'User register successfully.']);
    }

    public function login(Request $request)
    {
     $email = $request->input('email');
     $password = $request->input('password');

     $user = Admin::where('email', '=', $email)->first();
     if (!$user) {
        return response()->json(['success'=>false, 'message' => 'Login Fail, please check email']);
    }
    if (!Hash::check($password, $user->password)) {
        return response()->json(['success'=>false, 'message' => 'Login Fail, please check password']);
    }
    $success['token'] =  $user->createToken('MyApp')-> accessToken;
    $success['name'] =  $user->name;

    return response()->json(['status'=> 'success', 'data' => $success, 'message' => 'User login successfully.']);
}

public function getProfile()
{
    // $user = Auth::user()->id;
    $user = Auth::user();
    return response()->json($user);
}

public function updateProfile(AdminRequest $request)
{
    // $user = Auth::user()->token();
    $userid = Auth::user()->id;

    $input = $request->validated();
    if(!empty($input['password'])){
        $input['password'] = bcrypt($input['password']);
    }
    Admin::whereId($userid)->update($input);
    return response()->json($input);
}


}
