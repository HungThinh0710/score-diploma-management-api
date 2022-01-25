<?php

namespace App\Policies;

use App\ClassRoom;
use App\InQueueTranscript;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class InQueueTranscriptPolicy
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
        return $user->can('view transcript');
    }

    public function submit(User $user, ClassRoom $class)
    {
        if($user->can('submit transcript')){
            return $user->org_id == $class->org_id ? Response::allow() : Response::deny('This classroom is not exist in your organization.');
        }
        return Response::deny(self::DENY_PERMISSION_MESSAGE);
    }

    public function approve(User $user, InqueueTranscript $inQueueTranscript)
    {
        if($user->can('approve transcript')){
            return $user->org_id == $inQueueTranscript->classRoom->org_id? Response::allow() : Response::deny('This classroom is not exist in your organization.');
        }
        return Response::deny(self::DENY_PERMISSION_MESSAGE);
    }
}
