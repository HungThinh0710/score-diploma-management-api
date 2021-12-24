<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = $request->user('admin');
        return response()->json([
            'success' => true,
            'message' => 'Get users in organization successfully.',
            'users' => $users,
        ]);
    }
}
