<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Task;
use App\Http\Requests\Api\TaskRequest;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $task = Task::with('sender:id,name,phone', 'receiver:id,name,phone')->where('sender_id', Auth::user()->id)->orWhere('receiver_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
        return response($task);
    }
    //userın gönderdiği gönderiler
    public function sendertasks()
    {
        $tasks = \App\Task::with('courier:id,name,phone,image,email,vehicle,plate,color', 'receiver:id,name,phone')->where('sender_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
        return response($tasks);
    }

    //userın aldığı gönderiler
    public function receivertasks()
    {
        $tasks = \App\Task::with('courier:id,name,phone,image,email,vehicle,plate,color', 'sender:id,name,phone')->where('receiver_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
        return response($tasks);
    }

    public function store(TaskRequest $request)
    {
        $input = $request->validated();
        $task = Task::create($input);
        return response()->json('success');
    }

    public function edit($task) //user sender ise düzenleyebilsin
    {
        abort_unless(\Gate::allows('user-own-and-sender-task', $task), 403);
        $task = Task::with('courier:id,name', 'sender:id,name,image,phone,email', 'receiver:id,name,image,phone,email', 'senderaddress:id,user_id,city_id,district_id,name,description', 'senderaddress.city:id,name', 'senderaddress.district', 'receiveraddress:id,user_id,city_id,district_id,name,description', 'receiveraddress.city', 'receiveraddress.district')->findOrFail($task);
        return response()->json($task);
    }

    public function update(TaskRequest $request, Task $task)
    {
        abort_unless(\Gate::allows('user-own-and-sender-task', $task->id), 403);
        $input = $request->validated();
        if (!empty($input['password'])) {
            $input['password'] = bcrypt($input['password']);
        }
        $task->update($input);
        return response()->json('success');
    }
}
