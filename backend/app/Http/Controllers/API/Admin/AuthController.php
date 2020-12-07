<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\Admin\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Admin;
use Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password'  => 'required|min:3',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = Admin::create($input);
        $success['token'] =  $user->createToken($user->name)->accessToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User register successfully.');
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
    return $this->sendResponse($success, 'User login successfully.');
}
}
