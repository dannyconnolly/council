<?php

namespace App\Http\Controllers;

use App\Thread;

class ThreadSubscriptionsController extends Controller
{
    /**
     * Store a threads subscription.
     *
     * @param int $channelId
     * @param Thread $thread
     * @return
     */
    public function store($channelId, Thread $thread)
    {
        $thread->subscribe();
    }

    /**
     * Delete a threads subscription.
     *
     * @param int $channelId
     * @param Thread $thread
     * @return
     */
    public function destroy($channelId, Thread $thread)
    {
        $thread->unsubscribe();
    }
}
