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
}
