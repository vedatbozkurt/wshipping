<?php

namespace App\Http\Controllers\API\Admin;

use App\Branch;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BranchRequest;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $branches = $branch->city->district;
       // $branches = Branch::with('city','district')->orderBy('id', 'desc')->paginate(10);
        // $branches = \App\Branch::with('district.city')->orderBy('id','desc')->paginate(10);
        $branches = \App\Branch::withTrashed()->orderBy('id','desc')->paginate(3);
        // $branches = \App\Branch::with('city.branch.district')->orderBy('id','desc')->paginate(10);

        return response()->json($branches);
    }

public function all() //paginate olmadan tümü, dropdown için
{
    $branch = Branch::select('id', 'name')->withTrashed()->get();
    return response()->json($branch);
}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BranchRequest $request)
    {
        $input = $request->validated();
        $input['password'] = bcrypt($input['password']);
        $branch = Branch::create($request->all());

        $city=collect($request->city)->pluck('id');
        $city=$city->flatten();
        $branch->city()->sync($city);
        $district=collect($request->district)->pluck('id');
        $district=$district->flatten();
        $branch->district()->sync($district);

/*
        activity()->causedBy(Auth::user())->performedOn($branch)
        ->withProperties(['action' => 'create', 'status' => 'success'])
        ->log($branch->name.' branch successfully created');
*/
        return response()->json('success');
        // return response()->json(['status'=> 'success', 'data' => $success, 'message' => 'User register successfully.']);
    }


    public function edit($branch)
    {
        $branch = \App\Branch::with('city','district')->withTrashed()->findOrFail($branch);
        return response()->json($branch);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BranchRequest $request, Branch $branch)
    {
        $input = $request->validated();
        if(!empty($input['password'])){
            $input['password'] = bcrypt($input['password']);
        }
        $branch->update($request->all());

        $city=collect($request->city)->pluck('id');
        $city=$city->flatten();
        $branch->city()->sync($city);
        $district=collect($request->district)->pluck('id');
        $district=$district->flatten();
        $branch->district()->sync($district);
/*
        activity()->causedBy(Auth::user())->performedOn($branch)
        ->withProperties(['action' => 'update', 'status' => 'success'])
        ->log($branch->name.' branch successfully updated');
*/
        return response()->json('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $branch->delete(); //softDelete
        // $branch->forceDelete(); //soft olmayanı silme
        //
        // $branch= Branch::withTrashed()->find($branch->id);
        // $branch= Branch::onlyTrashed()->find($branch->id);
        // $branch = Branch::where('id',$branch)->withTrashed()->get();
        $branch = Branch::withTrashed()->find($id);
        $branch->city()->detach();
        $branch->district()->detach();
        $branch->forceDelete();
        // return response()->json($branch);
        return response()->json('success');
    }
    public function restore($id)
    {
        $branch = Branch::where('id',$id)->withTrashed()->first();
        $branch->restore();
        // return response()->json($branch);
        return response()->json('success');
    }

    public function getBranchCities($branch)
    {
       $cities =  Branch::find($branch)->city;
       // $cities = $cities->toArray();
       return response()->json($cities);
   }

   public function getBranchDistricts($branch)
   {
       $districts =  Branch::find($branch)->district;
       return response()->json($districts);
   }
    // şubenin sorumlu olduğu ilde courier olmadığından courier boş gelmesi normal
    public function couriers(Branch $branch) //şubenin sorumlu olduğu illerdeki kuryeler
    {
    // $courier = \App\Branch::with('city.courier','district.courier')->where('id',$branch)->orderBy('id', 'desc')->paginate(10);

        //şubenin il veya ilçelerindeki kuryeleri çekersen tüm kuryelerini çekmiş olursun
        $districts = $branch->district;

        $courier = [];
        foreach ($districts as $district) {
            array_push($courier,$district->courier);
        }
        $couriers=collect($courier)->flatten();
        $couriers = $couriers->unique('id');
        $couriers = $couriers->flatten();
        // let paginator to regonize page number automaticly

        return response()->json($couriers);
    }

// şubenin sorumlu olduğu ilde courier olmadığından courier boş gelmesi normal
    public function citycouriers($city) //şubenin sorumlu olduğu illerdeki kuryeler
    {
     // $cities =  $branch->city()->orderBy('id', 'desc')->paginate(10); //Branch $branch
     /*$cities->map(function ($city) {
        return $city->courier;
    });*/
  /*  $citycouriers = [];
    $couriers = \App\City::where('id',$city)->orderBy('id', 'desc')->get();
    foreach ($couriers as $courier) {
        array_push($citycouriers,$courier->courier);
    }
    $citycouriers=collect($citycouriers)->flatten();*/
    $citycouriers = \App\City::findorFail($city)->courier;
    return response()->json($citycouriers);
}

    public function districtcouriers($district) //şubenin sorumlu olduğu ilçelerdeki kuryeler
    {
       /*$districts =  $branch->district()->orderBy('id', 'desc')->paginate(10);  //Branch $branch
       $districts->map(function ($district) {
        return $district->courier;
    });*/
    $districtcouriers = \App\District::findorFail($district)->courier;
    return response()->json($districtcouriers);
}

public function users(Branch $branch){
    // $users = \App\Branch::with('city.users')->where('id',$branch)->orderBy('id', 'desc')->paginate(10);

    $districts = $branch->district;
    $user = [];
    foreach ($districts as $district) {
        array_push($user, $district->users);
    }
    $users=collect($user)->flatten();
    $users = $users->unique('id');
    $users = $users->flatten();
    return response()->json($users);
}

    // şubenin sorumlu olduğu ilde user olmadığından users boş gelmesi normal
     public function cityusers($city) //şubenin sorumlu olduğu illerdeki müşteriler
     {
       /*$cities =  $branch->city()->orderBy('id', 'desc')->paginate(10); //Branch $branch
       $cities->map(function ($city) {
        return $city->users;
    });*/
    $cityusers = \App\City::findorFail($city)->users;
    return response()->json($cityusers);
}

// şubenin sorumlu olduğu ilçede user olmadığından users boş gelmesi normal
    public function districtusers($district) //şubenin sorumlu olduğu ilçelerdeki müşteriler
    {
       /*$districts =  $branch->district()->orderBy('id', 'desc')->paginate(10); //Branch $branch
       $districts->map(function ($district) {
        return $district->users;
    });*/
    $districtusers = \App\District::findorFail($district)->users;
    return response()->json($districtusers);
}

public function tasks(Branch $branch){

    $districts = $branch->district;
    $task = [];
    foreach ($districts as $district) {
        array_push($task, $district->tasks);
    }
    $tasks=collect($task)->flatten();
    $tasks = $tasks->unique('id');
    $tasks = $tasks->flatten();
    return response()->json($tasks);
}

   public function citytasks($city) //şubenin sorumlu olduğu illerdeki gönderiler
   {
       /*$cities =  $branch->city()->orderBy('id', 'desc')->paginate(10); //Branch $branch
       $cities->map(function ($city) {
        return $city->tasks;
    });*/
    $citytasks = \App\City::findorFail($city)->tasks;
    return response()->json($citytasks);
}

    public function districttasks($district) //şubenin sorumlu olduğu ilçelerdeki gönderiler
    {
       /*$districts =  $branch->district()->orderBy('id', 'desc')->paginate(10); //Branch $branch
       $districts->map(function ($district) {
        return $district->tasks;
    });*/
    $districttasks = \App\District::findorFail($district)->tasks;
    return response()->json($districttasks);
}
}
