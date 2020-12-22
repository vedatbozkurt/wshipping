<?php

namespace App\Http\Controllers\API\Courier;

use App\Http\Controllers\Controller;
use App\User;

class DashboardController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }
}
