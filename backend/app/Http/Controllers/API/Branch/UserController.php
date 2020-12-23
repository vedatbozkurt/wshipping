<?php

namespace App\Http\Controllers\API\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\Api\UserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // şubenin kuryeleri
        $districts = Auth::user()->district;
        $users=[];
        foreach ($districts as $district) {
            array_push($users,$district->users);
        }
        $users=collect($users)->flatten();
        $users = $users->unique('id');
        // $users = $users->toArray()->paginate(10);
        return response($users);
    }

    public function store(UserRequest $request)
    {
        $input = $request->validated();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        return response()->json('success');
    }
    //user şubeye aitse düzenlenebilir
    public function edit(User $user)
    {
        abort_unless(\Gate::allows('branch-own-users',$user->id), 403);
        return response()->json($user);
    }

    public function update(UserRequest $request, User $user)
    {
        abort_unless(\Gate::allows('branch-own-users',$user->id), 403);
        $input = $request->validated();
        if(!empty($input['password'])){
            $input['password'] = bcrypt($input['password']);
        }
        $user->update($input);
        return response()->json('success');
    }

    public function destroy(User $user) // soft delete
    {
        abort_unless(\Gate::allows('branch-own-users',$user->id), 403); //user şubeninse burdan devam
        $user->delete();
        return response()->json('success');
    }

    public function addresses($user)
    {
        abort_unless(\Gate::allows('branch-own-users',$user), 403); //user şubeninse burdan devam
        $addresses = \App\User::with('address')->where('id',$user)->orderBy('id', 'desc')->paginate(10);
        return response($addresses);
    }

     //userın gönderdiği gönderiler
    public function sendertasks($user)
    {
        abort_unless(\Gate::allows('branch-own-users',$user), 403); //user şubeninse burdan devam
        $tasks = \App\User::with('tasksender')->where('id',$user)->orderBy('id', 'desc')->paginate(10);
        return response($tasks);
    }

    //userın aldığı gönderiler
    public function receivertasks($user)
    {
        abort_unless(\Gate::allows('branch-own-users',$user), 403); //user şubeninse burdan devam
        $tasks = \App\User::with('taskreceiver')->where('id',$user)->orderBy('id', 'desc')->paginate(10);
        return response($tasks);
    }

}
