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
        $user = User::withTrashed()->orderBy('id', 'desc')->paginate(10);
        // $user = User::with('address.city')->orderBy('id','desc')->paginate(10);
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

    public function edit($user)
    {
        $user = User::withTrashed()->find($user);
        //il ilçeyi adreste eklediği için burada gerek yok
        return response()->json($user);
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
    public function destroy($user)
    {
        $user = User::withTrashed()->find($user);
        $user->forceDelete();
        //müşteriye ait adresleri de sil
        \App\Address::where('user_id',$user)->delete();
        return response()->json('success');
    }

    public function restore($user)
    {
        $user = User::where('id',$user)->withTrashed()->first();
        $user->restore();
        return response()->json('success');
    }

    public function addresses($user)
    {
         $addresses = \App\User::with('address')->where('id',$user)->orderBy('id', 'desc')->paginate(10);
        // $user->address()->orderBy('id', 'desc')->paginate(10);
        return response($addresses);
    }

    //userın gönderdiği gönderiler
    public function sendertasks($user)
    {
        $tasks = \App\User::with('tasksender')->where('id',$user)->orderBy('id', 'desc')->paginate(10);
        return response($tasks);
    }

    //userın aldığı gönderiler
    public function receivertasks($user)
    {
        $tasks = \App\User::with('taskreceiver')->where('id',$user)->orderBy('id', 'desc')->paginate(10);
        return response($tasks);
    }
}
