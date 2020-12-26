<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Task;
use App\Http\Requests\Api\TaskRequest;

class TaskController extends Controller
{
    public function index()
    {
        // $task = Task::with('courier:id,name','sender:id,name,phone','receiver:id,name', 'senderaddress.city', 'senderaddress.district', 'receiveraddress.city', 'receiveraddress.district')->orderBy('id', 'desc')->paginate(10);
        $task = Task::with('courier:id,name','sender:id,name,phone','receiver:id,name,phone')->withTrashed()->orderBy('id', 'desc')->paginate(10);
        return response()->json($task);
    }

    public function store(TaskRequest $request)
    {
        $input = $request->validated();
        $task = Task::create($input);
        return response()->json('success');
    }

    public function edit($task)
    {
        // $city = \App\City::all(); //ile baglı ilçeleri de çek
        $task = Task::with('courier','sender','receiver', 'senderaddress.city', 'senderaddress.district', 'receiveraddress.city', 'receiveraddress.district')->withTrashed()->findOrFail($task);
        // return response()->json(array('task'=>$task,'city'=>$city));
        return response()->json($task);
    }

    public function update(TaskRequest $request, Task $task)
    {
        $input = $request->validated();
        if(!empty($input['password'])){
            $input['password'] = bcrypt($input['password']);
        }
        $task->update($input);
        return response()->json('success');
    }

    public function destroy($id)
    {
        $task = Task::withTrashed()->find($id);
        $task->forceDelete();
        return response()->json('success');
    }

    public function restore($id)
    {
        $task = Task::where('id',$id)->withTrashed()->first();
        $task->restore();
        return response()->json('success');
    }
}
