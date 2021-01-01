<?php

namespace App\Http\Controllers\API\Courier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Task;

class TaskController extends Controller
{
  public function courierTasks()
  { //kurye gönderileri
    $task = Task::with('sender:id,name,phone','receiver:id,name,phone')->where('courier_id',Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
    return response()->json($task);
  }

  public function index(Request $request){ //kurye bölgesine ait atanmamış gönderiler
    $districts=collect(Auth::user()->district)->pluck('id');
    $task = \App\Task::with('sender:id,name','receiver:id,name','senderaddress:id,user_id,city_id,district_id,name,description','senderaddress.city:id,name', 'senderaddress.district', 'receiveraddress:id,user_id,city_id,district_id,name,description', 'receiveraddress.city', 'receiveraddress.district')->whereHas("senderaddress",function($q) use($districts){
      $q->whereIn("district_id",$districts);
    })->where('status',1)->orWhere('status',8)->orderBy('id', 'desc')->paginate(10);
    return response()->json($task);
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
           //status
            //0:onay bekliyor
            //1:onaylandı-Kurye Ataması Bekleniyor
            //2:Kurye atandı-Kurye Kabul Etmesi Bekleniyor
            //3:Kurye Kabul etti
            //4:Kurye gönderiyi teslim aldı
            //5:Kurye yola çıktı
            //6:Kurye hedefe vardı
            //7:Gönderi teslim edildi
            //8:Kurye vazgeçti,yeni Kurye Kabul Etmesi Bekleniyor
            //9:İptal edildi
    switch ($task->status) {
          case 2: // kabul edebilir
          $newstatus =3;// kabul etti
          break;
          case 3:
          $newstatus =4; // yola gönderiyi teslim aldı
          break;
          case 4:
          $newstatus =5;// yola çıktı
          break;
          case 5:
          $newstatus =6;// hedefe vardı. teslim edildi
          break;
          case 6:
          $newstatus =7;// teslim edildi
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
    //log hangi kurye iptal ettiyse log tuttur
    $task->update([
        'status' => 8,
        'courier_id' => null,
      ]);
    return response()->json('success');
  }
  public function approved(Request $request, Task $task) //kurye gönderiyi kabul etmezse veya iptal ederse
  {
    $task->update([
        'status' => 3, //courier accepted
        'courier_id' => Auth::user()->id,
      ]);
    return response()->json('success');
  }
}

