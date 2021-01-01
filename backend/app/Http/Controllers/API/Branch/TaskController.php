<?php

namespace App\Http\Controllers\API\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Task;
use App\Http\Requests\Api\TaskRequest;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request){

        $districts=collect(Auth::user()->district)->pluck('id');
       $task = \App\Task::with('sender:id,name,phone','receiver:id,name,phone','senderaddress:id,district_id',)->whereHas("senderaddress",function($q) use($districts){
        $q->whereIn("district_id",$districts);
    })->orderBy('id', 'desc')->paginate(10);
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
        abort_unless(\Gate::allows('branch-own-task',$task), 403);
        $task = Task::with('courier','sender','receiver', 'senderaddress.city', 'senderaddress.district', 'receiveraddress.city', 'receiveraddress.district')->findOrFail($task);
        return response()->json($task);
    }

    public function update(TaskRequest $request, Task $task)
    {
        abort_unless(\Gate::allows('branch-own-task',$task->id), 403);
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

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json('success');
    }
}
