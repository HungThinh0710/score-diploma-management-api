<?php

namespace App\Http\Controllers\API\Client;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('org_id', 1)->paginate(2);
        return response()->json([
            'success' => true,
            'message' => 'Get users in organization successfully.',
            'users' => $users,
        ]);
    }
}
