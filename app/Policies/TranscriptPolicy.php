<?php

namespace App\Policies;

use App\ClassRoom;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TranscriptPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function submit(User $user, ClassRoom $class)
    {
        if($user->can('submit transcript')){
            return $user->org_id == $class->org_id ? Response::allow() : Response::deny('This classroom is not exist in your organization.');
        }
    }
}
