<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PermissionPolicy
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

    public function view(User $user)
    {
        return $user->can('view permission') ? Response::allow() : Response::deny(self::DENY_PERMISSION_MESSAGE);

    }
}
