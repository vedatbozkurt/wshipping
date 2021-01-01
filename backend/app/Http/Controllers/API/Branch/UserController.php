<?php

namespace App\Http\Controllers\API\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Address;
use App\Http\Requests\Api\UserRequest;
use App\Http\Requests\Api\AddressRequest;
use Illuminate\Support\Facades\Auth;
use File;

class UserController extends Controller
{

  public function all()
  {
    $districts = $branch = Auth::user()->district;
    $user = [];
    foreach ($districts as $district) {
      array_push($user, $district->users);
    }
    $users=collect($user)->flatten();
    $users = $users->sortByDesc('id')->unique('id');
    $users= $users->flatten();
    return response()->json($users);
  }

  public function allAddresses($user) //user all addresses
  {
    $addresses =  \App\User::find($user)->address;
    return response()->json($addresses);
  }

  public function index(Request $request)
  {
    $branch = Auth::user();
    $districts = $branch->district;
    $user = [];
    foreach ($districts as $district) {
      array_push($user, $district->users);
    }
    $users=collect($user)->flatten();
    $users = $users->sortByDesc('id')->unique('id');
    $users= $users->flatten()->toArray();

    $page = isset($request->page) ? $request->page : 1;
    $perPage = 10;
    $offset = ($page * $perPage) - $perPage;

    $current_page_orders = array_slice($users, $offset, $perPage);
    $orders_to_show = new \Illuminate\Pagination\LengthAwarePaginator($current_page_orders, count($users), $perPage);
    $orders_to_show->setPath($request->url());
    return response()->json($orders_to_show);
  }

  public function store(UserRequest $request)
  {
   $image_name='no-image.png';
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

  $address = array(
    'user_id'       =>   $user->id,
    'city_id'       =>   $request->city,
    'district_id'       =>   $request->district,
    'name'       =>   $request->addressname,
    'description'       =>   $request->description,
    'default'       =>   $request->default
  );

  Address::create($address);
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
  $image_name = $request->previous_image;
  $image = $request->file('image');
  if($image != '')
  {
    $image_path = "images/user/".$image_name;
    if(($image_name != 'no-image.png') && (File::exists($image_path))) {
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
        $addresses = \App\Address::with('city','district')->where('user_id',$user)->orderBy('id', 'desc')->paginate(10);
        return response()->json($addresses);
      }

     //userın gönderdiği gönderiler
      public function sendertasks($user)
      {
        abort_unless(\Gate::allows('branch-own-users',$user), 403); //user şubeninse burdan devam
        $tasks = \App\Task::with('courier:id,name,phone','receiver:id,name,phone')->where('sender_id',$user)->orderBy('id', 'desc')->paginate(10);
        return response()->json($tasks);
      }

    //userın aldığı gönderiler
      public function receivertasks($user)
      {
        abort_unless(\Gate::allows('branch-own-users',$user), 403); //user şubeninse burdan devam
        $tasks = \App\Task::with('courier:id,name,phone','sender:id,name,phone')->where('receiver_id',$user)->orderBy('id', 'desc')->paginate(10);
        return response()->json($tasks);
      }

    }
