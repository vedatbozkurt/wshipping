<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BranchRequest;
use App\Branch;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$branches = Branch::join('cities', 'cities.id', '=', 'branches.city_id')
       ->select('branches.*','cities.name as city_name')
       ->take(5)->get();*/
       $branches = Branch::with('city','district')->orderBy('id', 'desc')->paginate(10);
        return response($branches);
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
        $branch = Branch::create($input);
        $branch->city()->attach($request->city);
        $branch->district()->attach($request->district);


        activity()->causedBy(Auth::user())->performedOn($branch)
        ->withProperties(['action' => 'create', 'status' => 'success'])
        ->log($branch->name.' branch successfully created');

        return response()->json('success');
        // return response()->json(['status'=> 'success', 'data' => $success, 'message' => 'User register successfully.']);
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
        $branch->update($input);
        $branch->city()->sync($request->city);
        $branch->district()->sync($request->district);

        activity()->causedBy(Auth::user())->performedOn($branch)
        ->withProperties(['action' => 'update', 'status' => 'success'])
        ->log($branch->name.' branch successfully updated');

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
        $branch= Branch::withTrashed()->find($id)->forceDelete();
        return response()->json($branch);
    }
    public function restore($id)
    {
        $branch = \App\Branch::where('id',$id)->withTrashed()->first();
        $branch->restore();
        return response()->json($branch);
    }
}