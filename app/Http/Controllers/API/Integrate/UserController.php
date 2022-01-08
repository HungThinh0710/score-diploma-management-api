<?php

namespace App\Http\Controllers\API\Integrate;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = $request->user();
        return response()->json([
            'success' => true,
            'message' => 'Get users in organization successfully.',
            'users' => $users,
        ]);
    }
}
