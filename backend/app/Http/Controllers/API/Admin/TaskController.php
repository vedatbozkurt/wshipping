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
        $task = Task::with('courier:id,name,phone','sender:id,name,phone','receiver:id,name,phone')->withTrashed()->orderBy('id', 'desc')->paginate(10);
        return response()->json($task);
    }

    public function search($search)
    {
        $task = Task::withTrashed()->with('courier:id,name,phone','sender:id,name,phone','receiver:id,name,phone')
        ->whereHas("courier",function($q) use($search){
            $q->where('id', 'like', '%'.$search.'%')
            ->orWhere('name', 'like', '%'.$search.'%')
            ->orWhere('phone', 'like', '%'.$search.'%');
        })
        ->orWhereHas("sender",function($q) use($search){
            $q->where('id', 'like', '%'.$search.'%')
            ->orWhere('name', 'like', '%'.$search.'%')
            ->orWhere('phone', 'like', '%'.$search.'%');
        })
        ->orWhereHas("receiver",function($q) use($search){
            $q->where('id', 'like', '%'.$search.'%')
            ->orWhere('name', 'like', '%'.$search.'%')
            ->orWhere('phone', 'like', '%'.$search.'%');
        })
        ->orWhere('id', 'like', '%'.$search.'%')
        ->orWhere('price', 'like', '%'.$search.'%')
        ->orderBy('description', 'desc')->paginate(2);
        return response()->json($task);
    }

    public function store(TaskRequest $request)
    {
        $form_data = array(
            'courier_id'       =>   $request->courier['id'],
            'sender_id'       =>   $request->sender['id'],
            'receiver_id'       =>   $request->receiver['id'],
            'sender_address_id'       =>   $request->senderaddress['id'],
            'receiver_address_id'       =>   $request->receiveraddress['id'],
            'description'       =>   $request->description,
            'price'       =>   $request->price,
        );

        if(!empty($request->status)){
            $form_data += ['status' => $request->status];
        }

        Task::create($form_data);

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
        $form_data = array(
            'courier_id'       =>   $request->courier['id'],
            'sender_id'       =>   $request->sender['id'],
            'receiver_id'       =>   $request->receiver['id'],
            'sender_address_id'       =>   $request->senderaddress['id'],
            'receiver_address_id'       =>   $request->receiveraddress['id'],
            'description'       =>   $request->description,
            'price'       =>   $request->price,
            'status'       =>   $request->status,
        );

        $task->update($form_data);
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
