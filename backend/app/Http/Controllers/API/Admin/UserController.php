<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest;
use App\User;
use File;
class UserController extends Controller
{
  public function all()
  {
    $user = User::select('id', 'name')->withTrashed()->get();
    return response()->json($user);
  }

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

    public function search($search)
    {
      $user = User::search($search)->orderBy('id', 'desc')->paginate(10);
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
      $image_name='';
      $image = $request->file('image');
      if($image != '')
      {
        $image_name = rand(10000000,99999999) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/user'), $image_name);
      }

      $form_data = array(
        'name'       =>   $request->name,
        'phone'        =>   $request->phone,
        'email'        =>   $request->email,
        'password'        =>   bcrypt($request->password),
        'image'       =>   $image_name,
      );
      if(!empty($request['status'])){
        $form_data['status'] = ($request['status']);
      }

      $user = User::create($form_data);
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
      $image_name = $request->previous_image;
      $image = $request->file('image');
      if($image != '')
      {
      $image_path = "images/user/".$image_name;
      if(File::exists($image_path)) {
        File::delete($image_path);
      }
      $image_name = rand() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('images/user'), $image_name);
    }

    $form_data = array(
     'name'       =>   $request->name,
     'phone'        =>   $request->phone,
     'email'        =>   $request->email,
     'image'       =>   $image_name,

   );
    if(!empty($request['password'])){
      $form_data['password'] = bcrypt($request['password']);
    }
    $user->update($form_data);
    // Post::whereId($id)->update($form_data);

    return response()->json($request);
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

    public function allAddresses($user)
    {
         // $addresses = \App\User::with('address')->where('id',$user)->orderBy('id', 'desc')->paginate(10);
        // $user->address()->orderBy('id', 'desc')->paginate(10);
      $addresses =  \App\User::find($user)->address;
        // $addresses = \App\Address::where('user_id',$user)->get();

       /* $addresses =  \App\Address::with(['user' => function ($q) use ($user) {
            $q->where('id', $user);
          }])->orderBy('id', 'desc')->paginate(10);*/
          return response()->json($addresses);
        }

        public function addresses($user)
        {
         // $addresses = \App\User::with('address')->where('id',$user)->orderBy('id', 'desc')->paginate(10);
        // $user->address()->orderBy('id', 'desc')->paginate(10);
        // $addresses =  \App\User::find($user)->address;
          $addresses = \App\Address::with('city','district')->where('user_id',$user)->orderBy('id', 'desc')->paginate(10);

       /* $addresses =  \App\Address::with(['user' => function ($q) use ($user) {
            $q->where('id', $user);
          }])->orderBy('id', 'desc')->paginate(10);*/
          return response()->json($addresses);
        }

    //userın gönderdiği gönderiler
        public function sendertasks($user)
        {
        // $tasks = \App\User::with('tasksender')->where('id',$user)->orderBy('id', 'desc')->paginate(10);
          $tasks = \App\Task::with('courier:id,name,phone','receiver:id,name,phone')->where('sender_id',$user)->orderBy('id', 'desc')->paginate(10);
          return response()->json($tasks);
        }

    //userın aldığı gönderiler
        public function receivertasks($user)
        {
        // $tasks = \App\User::with('taskreceiver')->where('id',$user)->orderBy('id', 'desc')->paginate(10);
          $tasks = \App\Task::with('courier:id,name,phone','sender:id,name,phone')->where('receiver_id',$user)->orderBy('id', 'desc')->paginate(10);
          return response()->json($tasks);
        }
      }
