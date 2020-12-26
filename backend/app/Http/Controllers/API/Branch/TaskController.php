<?php

namespace App\Http\Controllers\API\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Task;
use App\Http\Requests\Api\TaskRequest;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(){

        $districts = Auth::user()->district;
        $task = [];
        foreach ($districts as $district) {
            array_push($task, $district->tasks);
        }
        $tasks=collect($task)->flatten();
        $tasks = $tasks->unique('id');
        return response()->json($tasks);
    }
    public function store(TaskRequest $request)
    {
        $input = $request->validated();
        $task = Task::create($input);
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
        $input = $request->validated();
        if(!empty($input['password'])){
            $input['password'] = bcrypt($input['password']);
        }
        $task->update($input);
        return response()->json('success');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json('success');
    }
}
