<?php

namespace App\Http\Controllers\API\Integrate;

use App\Http\Controllers\Controller;
use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Get permissions successfully.',
            'permissions' => Permission::all()
        ]);
    }
}
