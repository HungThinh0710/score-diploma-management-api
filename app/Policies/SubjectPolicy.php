<?php

namespace App\Policies;

use App\Subject;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SubjectPolicy
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
        return $user->can('view subject') ? Response::allow() : Response::deny(self::DENY_PERMISSION_MESSAGE);
    }

    public function create(User $user)
    {
        return $user->can('create subject') ? Response::allow() : Response::deny(self::DENY_PERMISSION_MESSAGE);
    }

    public function update(User $user, Subject $subject)
    {
        if($user->can('update subject')){
            return $user->org_id == $subject->major->org_id ? Response::allow() : Response::deny('This subject is not exist in your organization.');
        }
        return self::DENY_PERMISSION_MESSAGE;
    }

    public function delete(User $user, Subject $subject)
    {
        if($user->can('delete subject')){
            return $user->org_id == $subject->major->org_id ? Response::allow() : Response::deny('This subject is not exist in your organization.');
        }
        return self::DENY_PERMISSION_MESSAGE;
    }



}
