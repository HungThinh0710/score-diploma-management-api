<?php

namespace App\Policies;

use App\Role;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RolePolicy
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
        return $user->can('view role') ? Response::allow() : Response::deny(self::DENY_PERMISSION_MESSAGE);
    }

    public function create(User $user)
    {
        return $user->can('create role') ? Response::allow() : Response::deny(self::DENY_PERMISSION_MESSAGE);
    }

    public function update(User $user, Role $role)
    {
        if ($user->can('edit role'))
            return $user->org_id == $role->org_id ? Response::allow() : Response::deny(self::DENY_PERMISSION_MESSAGE);
        return Response::deny(self::DENY_PERMISSION_MESSAGE);
    }

    public function delete(User $user, Role $role)
    {
        if ($user->can('delete role'))
            return $user->org_id == $role->org_id ? Response::allow() : Response::deny(self::DENY_PERMISSION_MESSAGE);
        return Response::deny(self::DENY_PERMISSION_MESSAGE);
    }

    public function managePermissionRole(User $user, Role $role)
    {
        if ($user->can('manage permission role'))
            return $user->org_id == $role->org_id ? Response::allow() : Response::deny(self::DENY_PERMISSION_MESSAGE);
        return Response::deny(self::DENY_PERMISSION_MESSAGE);

    }
}
