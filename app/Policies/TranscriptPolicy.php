<?php

namespace App\Policies;

use App\ClassRoom;
use App\Transcript;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TranscriptPolicy
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



    public function view(User $user, Transcript $transcript)
    {
        if($user->can('view transcript')){
            return $user->org_id == $transcript->classRoom->org_id ? Response::allow() : Response::deny('This transcript is not exist in your organization.');
        }
        return Response::deny(self::DENY_PERMISSION_MESSAGE);
    }

    public function viewAll(User $user)
    {
        return $user->can('view transcript') ? Response::allow() : Response::deny(self::DENY_PERMISSION_MESSAGE);
    }

    public function submit(User $user, ClassRoom $class)
    {
        if($user->can('submit transcript')){
            return $user->org_id == $class->org_id ? Response::allow() : Response::deny('This classroom is not exist in your organization.');
        }
        return Response::deny(self::DENY_PERMISSION_MESSAGE);
    }

    public function history(User $user)
    {
        return $user->can('history transcript') ? Response::allow() : Response::deny(self::DENY_PERMISSION_MESSAGE);


    }

    public function update(User $user, ClassRoom $classroom)
    {
        if($user->can('update transcript')){
            return $user->org_id == $classroom->org_id ? Response::allow() : Response::deny('This classroom is not exist in your organization.');
        }
        return Response::deny(self::DENY_PERMISSION_MESSAGE);

    }
}
