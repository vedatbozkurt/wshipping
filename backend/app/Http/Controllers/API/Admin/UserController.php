<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest;
use App\User;

class UserController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::orderBy('id', 'desc')->paginate(10);
        return response($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $input = $request->validated();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        return response()->json('success');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $input = $request->validated();
        if(!empty($input['password'])){
            $input['password'] = bcrypt($input['password']);
        }
        $user->update($input);

        return response()->json('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::withTrashed()->find($id);
        $user->forceDelete();
        //müşteriye ait adresleri de sil
        \App\Address::where('user_id',$id)->delete();
        return response()->json('success');
    }

    public function restore($id)
    {
        $user = User::where('id',$id)->withTrashed()->first();
        $user->restore();
        return response()->json('success');
    }

    public function addresses(User $user)
    {
        $addresses = $user->address()->orderBy('id', 'desc')->paginate(10);
        return response($addresses);
    }
}
