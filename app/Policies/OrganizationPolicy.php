<?php

namespace App\Policies;

use App\Organization;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class OrganizationPolicy
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

    public function view(User $user, Organization $organization)
    {
        if($user->can('view organization'))
            return $user->org_id == $organization->id ? Response::allow() : Response::deny('You are not a member of this organization.');
        return Response::deny(self::DENY_PERMISSION_MESSAGE);
    }

    public function update(User $user, Organization $organization)
    {
        if($user->can('edit organization') || ($user->is_owner == 1 && $user->org_id == $organization->id)){
            return $user->org_id == $organization->id ? Response::allow() : Response::deny('You are not a admin of this organization.');
        }
        return Response::deny('You do not have permission to edit organization.');
    }

    public function users(User $user)
    {
        return response()->json($user->roles());
        return $user->can('view user organization') ? Response::allow() : Response::deny(self::DENY_PERMISSION_MESSAGE);

    }
}
