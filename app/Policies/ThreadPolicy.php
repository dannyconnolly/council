<?php

namespace App\Policies;

use App\User;
use App\Thread;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThreadPolicy
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

    /**
     * Determine whether the user can view a thread
     * 
     * @param \App\User $user
     * @param \App\Thread $thread
     * @return mixed
     */
    public function view(User $user, Thread $thread)
    {
        //
    }

    /**
     * Determine whether the user can create a thread
     * 
     * @param \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update a thread
     * 
     * @param \App\User $user
     * @param \App\Thread $thread
     * @return mixed
     */
    public function update(User $user, Thread $thread)
    {
        return $thread->user_id == $user->id; 
    }

    /**
     * Determine whether the user can delete a thread
     * 
     * @param \App\User $user
     * @param \App\Thread $thread
     * @return mixed
     */
    public function delete(User $user, Thread $thread)
    {
        //
    }
}
