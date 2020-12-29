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
    return response()->json($user);
}
public function all()
{
    $user = User::select('id', 'name')->withTrashed()->get();
    return response()->json($user);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $request['password'] = bcrypt($request['password']);
        $user = User::create($request->all());
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
        if(!empty($request['password'])){
            $request['password'] = bcrypt($request['password']);
        }
        $user->update($request->all());

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
         // $addresses = \App\User::with('address')->where('id',$user)->orderBy('id', 'desc')->paginate(10);
        // $user->address()->orderBy('id', 'desc')->paginate(10);
        // $addresses =  \App\User::find($user)->address;
        $addresses = \App\Address::with('city','district')->where('user_id',$user)->get();

       /* $addresses =  \App\Address::with(['user' => function ($q) use ($user) {
            $q->where('id', $user);
        }])->orderBy('id', 'desc')->paginate(10);*/
        return response()->json($addresses);
    }

    //userın gönderdiği gönderiler
    public function sendertasks($user)
    {
        // $tasks = \App\User::with('tasksender')->where('id',$user)->orderBy('id', 'desc')->paginate(10);
        $tasks = \App\Task::with('courier:id,name,phone','receiver:id,name,phone')->where('sender_id',$user)->get();
        return response()->json($tasks);
    }

    //userın aldığı gönderiler
    public function receivertasks($user)
    {
        // $tasks = \App\User::with('taskreceiver')->where('id',$user)->orderBy('id', 'desc')->paginate(10);
        $tasks = \App\Task::with('courier:id,name,phone','sender:id,name,phone')->where('receiver_id',$user)->get();
        return response()->json($tasks);
    }
}
