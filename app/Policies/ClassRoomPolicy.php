<?php

namespace App\Policies;

use App\ClassRoom;
use App\Role;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ClassRoomPolicy
{
    use HandlesAuthorization;
    private const DENY_PERMISSION_MESSAGE = "You do not have permission to do this action";

    public function view(User $user)
    {
        return $user->can('view class') ? Response::allow() : Response::deny(self::DENY_PERMISSION_MESSAGE);
    }

    public function create(User $user)
    {
        return $user->can('create class') ? Response::allow() : Response::deny(self::DENY_PERMISSION_MESSAGE);
    }
}
