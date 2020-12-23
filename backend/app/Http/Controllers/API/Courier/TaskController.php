<?php

namespace App\Http\Controllers\API\Courier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Task;

class TaskController extends Controller
{
    public function index()
    {
        // abort_unless(\Gate::allows('branch-own-users',$user), 403);
        // $tasks = \App\Task::with('user')->orderBy('id', 'desc')->paginate(10);
        $task = Task::with('sender:id,name,phone','receiver:id,name,phone')->where('courier_id',Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
        return response($task);
    }

    public function edit($task)
    {
        abort_unless(\Gate::allows('courier-own-task',$task), 403);
        $task = Task::with('courier:id,name','sender:id,name,image,phone,email','receiver:id,name,image,phone,email', 'senderaddress:id,user_id,city_id,district_id,name,description','senderaddress.city:id,name', 'senderaddress.district', 'receiveraddress:id,user_id,city_id,district_id,name,description', 'receiveraddress.city', 'receiveraddress.district')->findOrFail($task);
        return response()->json($task);
    }

    public function update(Task $task)
    {
        abort_unless(\Gate::allows('courier-own-task',$task->id), 403);
        //status
            //0:onay bekliyor
            //1:onaylandı-Kurye Ataması Bekleniyor
            //2:Kurye atandı-Kurye Kabul Etmesi Bekleniyor
            //3:Kurye Kabul etti
            //4:Kurye yola çıktı
            //5:Kurye hedefe vardı
            //6:Gönderi teslim edildi
            //7:İptal edildi-Kurye vazgeçti,yeni Kurye Kabul Etmesi Bekleniyor
        switch ($task->status) {
          case 2: // kabul edebilir
          $newstatus =3;// kabul etti
          break;
          case 3:
          $newstatus =4; // yola çıktı
          break;
          case 4:
          $newstatus =5;// hedefe vardı
          break;
          case 5:
          $newstatus =6;// teslim edildi
          break;
          default:
          $newstatus = $task->status;
      }
      $task->update([
        'status' => $newstatus,
    ]);
      return response()->json('success');
  }
  public function cancel(Request $request, Task $task) //kurye gönderiyi kabul etmezse veya iptal ederse
  {
    abort_unless(\Gate::allows('courier-own-task',$task->id), 403);
    $task->update([
        'status' => $request->type, //type 7 iptal veya 8 kabul etmeme
    ]);
    return response()->json('success');
}
}
