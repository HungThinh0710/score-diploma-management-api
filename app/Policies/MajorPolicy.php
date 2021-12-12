<?php

namespace App\Policies;

use App\User;
use App\Major;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MajorPolicy
{
    use HandlesAuthorization;
    private const DENY_PERMISSION_MESSAGE = "You do not have permission to do this action";

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function checkMajorWithId(User $user, Major $major)
    {
        return $user->org_id == $major->org_id ? Response::allow() : Response::deny('This major is not exists in your organization');
    }

    public function view(User $user)
    {
        return $user->can('view major') ? Response::allow() : Response::deny(self::DENY_PERMISSION_MESSAGE);
    }

    public function create(User $user)
    {
        return $user->can('create major') ? Response::allow() : Response::deny(self::DENY_PERMISSION_MESSAGE);
    }

    public function update(User $user, Major $major)
    {
        if($user->can('update major')){
            return $user->org_id == $major->org_id ? Response::allow() : Response::deny('This major is not exist in your organization');
        }
        return self::DENY_PERMISSION_MESSAGE;
    }

    public function delete(User $user, Major $major)
    {
        if($user->can('delete major')){
            return $user->org_id == $major->org_id ? Response::allow() : Response::deny('This major is not exist in your organization');
        }
        return self::DENY_PERMISSION_MESSAGE;
    }

}
