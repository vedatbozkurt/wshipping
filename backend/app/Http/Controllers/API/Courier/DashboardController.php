<?php

namespace App\Http\Controllers\API\Courier;

use App\Http\Controllers\Controller;
use App\User;

class DashboardController extends Controller
{
    public function show()
    {
        return response()->json('dashboard loading');
    }
}
