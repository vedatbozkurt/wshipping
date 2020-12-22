<?php

namespace App\Http\Controllers\API\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class DashboardController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }
}
