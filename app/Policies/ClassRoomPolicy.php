<?php

namespace App\Policies;

use App\ClassRoom;
use App\Role;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use phpDocumentor\Reflection\Types\Self_;

class ClassRoomPolicy
{
    use HandlesAuthorization;
    private const DENY_PERMISSION_MESSAGE = "You do not have permission to do this action";

    public function view(User $user)
    {
        // dd($user->can('view user organization'));
        // dd($user->roles);
        return $user->can('view class') ? Response::allow() : Response::deny(self::DENY_PERMISSION_MESSAGE);
    }

    public function create(User $user)
    {
        return $user->can('create class') ? Response::allow() : Response::deny(self::DENY_PERMISSION_MESSAGE);
    }

    public function update(User $user, ClassRoom $classRoom)
    {
        if($user->can('edit class')){
            return $user->org_id == $classRoom->org_id ? Response::allow() : Response::deny('This class is not exists in your organization');
        }
        return self::DENY_PERMISSION_MESSAGE;
    }
}
